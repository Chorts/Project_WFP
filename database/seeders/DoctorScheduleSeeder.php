<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctor_schedules')->insert([
            [
                'doctor_id' => 1,
                'day' => 'Senin',
                'start_time' => '08:00:00',
                'end_time' => '08:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'day' => 'Senin',
                'start_time' => '08:30:00',
                'end_time' => '09:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'day' => 'Senin',
                'start_time' => '09:00:00',
                'end_time' => '09:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'day' => 'Senin',
                'start_time' => '09:30:00',
                'end_time' => '10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'day' => 'Senin',
                'start_time' => '13:00:00',
                'end_time' => '13:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
