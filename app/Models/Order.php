<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'phone',
        'address',
        'total',
        'status',
        'payment_method',
        'payment_status',
        'paid_at',
        'refund_amount',
        'refund_status',
        'refund_reason',
        'refunded_at',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'refund_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getNetTotalAttribute(): float
    {
        return max(
            (float) $this->total - (float) $this->refund_amount,
            0
        );
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format(
            (float) $this->total,
            0,
            ',',
            '.'
        );
    }

    public function getFormattedRefundAttribute(): string
    {
        return 'Rp ' . number_format(
            (float) $this->refund_amount,
            0,
            ',',
            '.'
        );
    }

    public function getFormattedNetTotalAttribute(): string
    {
        return 'Rp ' . number_format(
            $this->net_total,
            0,
            ',',
            '.'
        );
    }
}