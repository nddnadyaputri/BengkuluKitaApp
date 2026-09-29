<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('refund_amount', 15, 2)
                ->default(0)
                ->after('total');

            $table->string('refund_status')
                ->default('none')
                ->after('refund_amount');

            $table->text('refund_reason')
                ->nullable()
                ->after('refund_status');

            $table->timestamp('refunded_at')
                ->nullable()
                ->after('refund_reason');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'refund_amount',
                'refund_status',
                'refund_reason',
                'refunded_at',
            ]);
        });
    }
};