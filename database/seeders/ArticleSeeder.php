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
                'title' => 'Tips Hidup Sehat',
                'article' => 'Minum air yang cukup dan olahraga rutin.',
                'date_published' => now(),
                'doctor_id' => 1,
            ],
            [
                'title' => 'Cara Menjaga Kulit',
                'article' => 'Gunakan sunscreen setiap hari.',
                'date_published' => now(),
                'doctor_id' => 2,
            ],
        ]);
    }
}
