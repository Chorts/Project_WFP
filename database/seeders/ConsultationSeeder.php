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
                'member_id' => 3,
                'status' => 'Selesai',

                'started_at' => now()->subDays(5),
                'ended_at' => now()->subDays(5)->addMinutes(20),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'doctor_id' => 2,
                'member_id' => 7,
                'status' => 'Selesai',

                'started_at' => now()->subDays(3),
                'ended_at' => now()->subDays(3)->addMinutes(15),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 3,
                'doctor_id' => 3,
                'member_id' => 8,
                'status' => 'Aktif',

                'started_at' => now()->subHours(2),
                'ended_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 4,
                'doctor_id' => 1,
                'member_id' => 3,
                'status' => 'Aktif',

                'started_at' => now()->subMinutes(30),
                'ended_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
