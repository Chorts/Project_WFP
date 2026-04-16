<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'service_name' => 'Konsultasi Dokter Online',
                'description' => 'Layanan konsultasi kesehatan secara online dengan dokter umum.',
                'category_id' => 1,
                'price' => 50000
            ],
            [
                'service_name' => 'Konsultasi Spesialis Jantung',
                'description' => 'Konsultasi dengan dokter spesialis jantung.',
                'category_id' => 2,
                'price' => 150000
            ],
            [
                'service_name' => 'Medical Checkup Basic',
                'description' => 'Pemeriksaan kesehatan dasar.',
                'category_id' => 3,
                'price' => 200000
            ],
            [
                'service_name' => 'Tes Darah Lengkap',
                'description' => 'Pemeriksaan darah lengkap di laboratorium.',
                'category_id' => 4,
                'price' => 120000
            ],
            [
                'service_name' => 'Telemedicine Premium',
                'description' => 'Konsultasi online prioritas dengan dokter.',
                'category_id' => 5,
                'price' => 100000
            ],
            [
                'service_name' => 'Konsultasi Kulit',
                'description' => 'Konsultasi masalah kulit dan alergi.',
                'category_id' => 2,
                'price' => 130000
            ],
            [
                'service_name' => 'Medical Checkup Lengkap',
                'description' => 'Pemeriksaan kesehatan menyeluruh.',
                'category_id' => 3,
                'price' => 350000
            ],
            [
                'service_name' => 'Tes Urine',
                'description' => 'Pemeriksaan urine untuk diagnosa penyakit.',
                'category_id' => 4,
                'price' => 80000
            ],
            [
                'service_name' => 'Konsultasi Gizi',
                'description' => 'Konsultasi pola makan dan nutrisi.',
                'category_id' => 1,
                'price' => 90000
            ],
            [
                'service_name' => 'Telemedicine Darurat',
                'description' => 'Layanan konsultasi cepat untuk kondisi darurat.',
                'category_id' => 5,
                'price' => 150000
            ],
        ]);
    }
}
