<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'status',
        'booking_date'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function schedule()
    {
        return $this->belongsTo(DoctorSchedule::class, 'schedule_id');
    }
    public function consultation()
    {
        return $this->hasOne(Consultation::class, 'booking_id');
    }
}
