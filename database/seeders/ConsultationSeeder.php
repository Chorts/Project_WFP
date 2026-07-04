<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('consultations')->insert([
            [
                'booking_id' => 1,
                'doctor_id' => 1,
                'user_id' => 3,
                'status' => 'Selesai',

                'started_at' => now()->subDays(5),
                'ended_at' => now()->subDays(5)->addMinutes(20),
                'ringkasan' => 'Pasien mengeluh demam dan sakit kepala selama 2 hari. Disarankan istirahat cukup dan minum obat penurun panas. Kontrol kembali jika demam tidak turun dalam 3 hari.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'doctor_id' => 2,
                'user_id' => 7,
                'status' => 'Selesai',

                'started_at' => now()->subDays(3),
                'ended_at' => now()->subDays(3)->addMinutes(15),
                'ringkasan' => 'Konsultasi terkait keluhan nyeri lambung setelah makan. Diduga gejala maag ringan. Disarankan menghindari makanan pedas dan asam, serta diberikan resep obat lambung.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 3,
                'doctor_id' => 3,
                'user_id' => 8,
                'status' => 'Aktif',

                'started_at' => now()->subHours(2),
                'ended_at' => null,
                'ringkasan' => 'Pasien melaporkan batuk kering dan tenggorokan gatal sejak kemarin. Sesi konsultasi masih berlangsung, menunggu hasil pemeriksaan lanjutan sebelum diberikan rekomendasi obat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 4,
                'doctor_id' => 1,
                'user_id' => 3,
                'status' => 'Aktif',

                'started_at' => now()->subMinutes(30),
                'ended_at' => null,
                'ringkasan' => 'Pasien berkonsultasi mengenai nyeri sendi pada lutut setelah aktivitas olahraga. Dokter sedang meninjau riwayat cedera sebelumnya sebelum memberikan rekomendasi penanganan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
