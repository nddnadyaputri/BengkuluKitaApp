<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->string('midtrans_order_id')->nullable()->unique()->after('paid_at');
            $table->string('snap_token')->nullable()->after('midtrans_order_id');
            $table->string('payment_type')->nullable()->after('snap_token');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn(['midtrans_order_id', 'snap_token', 'payment_type']);
        });
    }
};
