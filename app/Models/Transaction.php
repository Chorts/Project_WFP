<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'status',
        'price',
        'transaction_date'
    ];

    // Relasi ke Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
