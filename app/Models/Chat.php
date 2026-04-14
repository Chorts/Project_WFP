<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat',
        'doctor_id',
        'user_id',
    ];

    // Relasi ke doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    // Relasi ke service
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
