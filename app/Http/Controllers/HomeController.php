<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | INFORMASI WEBSITE
        |--------------------------------------------------------------------------
        */

        $settings = SiteSetting::first();

        // Jika data pengaturan belum ada, buat data default
        if (!$settings) {
            $settings = SiteSetting::create([
                'business_name' => 'BengkuluKita',
                'description' => 'Platform untuk mengenal dan membeli berbagai oleh-oleh khas Bengkulu.',
                'footer_text' => 'Pusatnya Oleh-Oleh Bengkulu.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PRODUK TERBARU
        |--------------------------------------------------------------------------
        */

        $products = Product::latest()
            ->take(6)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | FAQ
        |--------------------------------------------------------------------------
        */

        $faqs = [
            [
                'question' => 'Bagaimana cara membeli produk di BengkuluKita?',
                'answer' => 'Pilih produk yang ingin dibeli, masukkan ke keranjang, kemudian lanjutkan ke proses checkout dan isi data pemesanan.'
            ],

            [
                'question' => 'Metode pembayaran apa saja yang tersedia?',
                'answer' => 'BengkuluKita menyediakan beberapa metode pembayaran sesuai pilihan yang tersedia pada halaman checkout, seperti transfer bank, QRIS, dan COD.'
            ],

            [
                'question' => 'Apakah produk bisa dipesan untuk dikirim?',
                'answer' => 'Ya. Informasi pengiriman dapat disesuaikan dengan alamat yang dimasukkan saat checkout. Untuk pertanyaan mengenai pengiriman, pelanggan juga dapat menghubungi admin.'
            ],

            [
                'question' => 'Bagaimana jika produk yang saya terima bermasalah?',
                'answer' => 'Segera hubungi admin BengkuluKita melalui WhatsApp atau kontak yang tersedia dengan menyertakan informasi pesanan agar dapat dibantu.'
            ],

            [
                'question' => 'Apakah saya bisa bertanya sebelum membeli?',
                'answer' => 'Tentu. Jika memiliki pertanyaan mengenai produk, stok, harga, atau pemesanan, pelanggan dapat langsung menghubungi admin melalui kontak yang tersedia.'
            ],

            [
                'question' => 'Bagaimana cara menghubungi BengkuluKita?',
                'answer' => 'Pelanggan dapat menghubungi BengkuluKita melalui WhatsApp, email, Instagram, Facebook, atau TikTok yang tercantum pada bagian kontak.'
            ],
        ];


        return view('home', compact(
            'settings',
            'products',
            'faqs'
        ));
    }
}