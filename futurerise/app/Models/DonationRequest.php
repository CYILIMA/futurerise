<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'donation_type',
        'amount',
        'message',
        'is_contacted',
    ];

    protected $casts = [
        'is_contacted' => 'boolean',
    ];
}
