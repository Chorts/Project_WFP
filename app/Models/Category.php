<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name'
    ];

    // Relasi ke doctor
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'category_id');
    }

    // Relasi ke service
    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}
