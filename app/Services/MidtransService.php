<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class MidtransService
{
    public function isConfigured(): bool
    {
        return filled(config('services.midtrans.server_key'))
            && filled(config('services.midtrans.client_key'));
    }

    public function clientKey(): ?string
    {
        return config('services.midtrans.client_key');
    }

    public function snapJsUrl(): string
    {
        return config('services.midtrans.is_production')
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    }

    private function snapUrl(): string
    {
        return config('services.midtrans.is_production')
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    }

    private function statusUrl(string $orderId): string
    {
        $base = config('services.midtrans.is_production')
            ? 'https://api.midtrans.com'
            : 'https://api.sandbox.midtrans.com';

        return "{$base}/v2/{$orderId}/status";
    }

    /** Buat Snap token untuk sebuah pesanan (dan simpan di database). */
    public function createSnapToken(Order $order): string
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Payment gateway belum dikonfigurasi. Isi MIDTRANS_SERVER_KEY dan MIDTRANS_CLIENT_KEY di file .env.');
        }

        $order->loadMissing('items.product');

        $items = $order->items->map(fn ($item) => [
            'id' => (string) $item->product_id,
            'price' => (int) round($item->price),
            'quantity' => (int) $item->quantity,
            'name' => mb_substr($item->product?->name ?? 'Produk', 0, 50),
        ])->values()->all();

        $midtransOrderId = 'BK-' . $order->id . '-' . now()->format('His');

        $response = Http::withBasicAuth(config('services.midtrans.server_key'), '')
            ->acceptJson()
            ->timeout(20)
            ->post($this->snapUrl(), [
                'transaction_details' => [
                    'order_id' => $midtransOrderId,
                    'gross_amount' => (int) round($order->total),
                ],
                'item_details' => $items,
                'enabled_payments' => ['other_qris'],
                'customer_details' => [
                    'first_name' => mb_substr($order->customer_name, 0, 50),
                    'phone' => $order->phone,
                ],
                'callbacks' => [
                    'finish' => route('checkout.success', $order),
                ],
            ]);

        if (! $response->successful() || ! $response->json('token')) {
            throw new RuntimeException('Gagal membuat transaksi pembayaran. Silakan coba lagi.');
        }

        $order->update([
            'midtrans_order_id' => $midtransOrderId,
            'snap_token' => $response->json('token'),
        ]);

        return $response->json('token');
    }

    /** Verifikasi signature notifikasi dari Midtrans. */
    public function validSignature(array $payload): bool
    {
        $expected = hash('sha512',
            ($payload['order_id'] ?? '')
            . ($payload['status_code'] ?? '')
            . ($payload['gross_amount'] ?? '')
            . config('services.midtrans.server_key')
        );

        return hash_equals($expected, (string) ($payload['signature_key'] ?? ''));
    }

    /** Tanya status transaksi langsung ke Midtrans (dipakai saat webhook belum masuk). */
    public function syncStatus(Order $order): void
    {
        if (! $this->isConfigured() || ! $order->midtrans_order_id) {
            return;
        }

        try {
            $response = Http::withBasicAuth(config('services.midtrans.server_key'), '')
                ->acceptJson()
                ->timeout(8)
                ->get($this->statusUrl($order->midtrans_order_id));

            if ($response->successful() && $response->json('transaction_status')) {
                $this->applyStatus($order, $response->json());
            }
        } catch (\Throwable $e) {
            report($e);
        }
    }

    /** Terapkan status transaksi Midtrans ke pesanan. */
    public function applyStatus(Order $order, array $payload): void
    {
        $status = $payload['transaction_status'] ?? null;
        $fraud = $payload['fraud_status'] ?? 'accept';

        DB::transaction(function () use ($order, $payload, $status, $fraud) {
            $order = Order::whereKey($order->id)->lockForUpdate()->first();

            if (! empty($payload['payment_type'])) {
                $order->payment_type = $payload['payment_type'];
            }

            $paid = $order->payment_status === 'Dibayar';

            if (in_array($status, ['settlement', 'capture'], true) && $fraud === 'accept') {
                $order->payment_status = 'Dibayar';
                $order->paid_at = $order->paid_at ?? now();
            } elseif ($status === 'pending' && ! $paid) {
                $order->payment_status = 'Menunggu Pembayaran';
            } elseif (in_array($status, ['deny', 'cancel', 'expire', 'failure'], true) && ! $paid) {
                $order->payment_status = 'Belum Dibayar';

                if ($order->status !== 'Dibatalkan') {
                    $order->status = 'Dibatalkan';
                    foreach ($order->items()->with('product')->get() as $item) {
                        $item->product?->increment('stock', $item->quantity);
                    }
                }
            }

            $order->save();
        });
    }
}
