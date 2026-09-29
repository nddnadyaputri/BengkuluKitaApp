<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MidtransNotificationController extends Controller
{
    public function __invoke(Request $request, MidtransService $midtrans): JsonResponse
    {
        $payload = $request->all();

        if (! $midtrans->validSignature($payload)) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $order = Order::where('midtrans_order_id', $payload['order_id'] ?? '')->first();

        if (! $order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $midtrans->applyStatus($order, $payload);

        return response()->json(['message' => 'OK']);
    }
}
