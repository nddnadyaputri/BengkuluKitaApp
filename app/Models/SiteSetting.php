<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'business_name',
        'description',
        'phone',
        'whatsapp',
        'email',
        'instagram',
        'facebook',
        'tiktok',
        'address',
        'opening_hours',
        'logo',
        'footer_text',
    ];
}