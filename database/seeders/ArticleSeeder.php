<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('articles')->insert([
            [
                'title' => 'Cara Menjaga Kesehatan Jantung Sehari-hari',
                'article' => 'Menjaga kesehatan jantung bisa dimulai dari pola makan sehat, olahraga rutin, dan menghindari stres berlebih...',
                'date_published' => now(),
                'doctor_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tips Mengatasi Jerawat dengan Benar',
                'article' => 'Jerawat dapat disebabkan oleh hormon, makanan, dan kebersihan kulit. Gunakan skincare yang sesuai...',
                'date_published' => now(),
                'doctor_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pentingnya Medical Checkup Rutin',
                'article' => 'Medical checkup membantu mendeteksi penyakit lebih awal sebelum menjadi serius...',
                'date_published' => now(),
                'doctor_id' => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cara Menjaga Kesehatan Anak',
                'article' => 'Anak membutuhkan nutrisi seimbang, imunisasi lengkap, dan pola tidur yang cukup...',
                'date_published' => now(),
                'doctor_id' => 4, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
