<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bookings')->insert([
            [
                'user_id' => 3,
                'service_id' => 1,
                'schedule_id' => 1,
                'status' => 'Selesai',
                'booking_date' => '2026-04-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'service_id' => 1,
                'schedule_id' => 2,
                'status' => 'Selesai',
                'booking_date' => '2026-04-11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'service_id' => 1,
                'schedule_id' => 3,
                'status' => 'Dipesan',
                'booking_date' => '2026-04-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'service_id' => 1,
                'schedule_id' => 4,
                'status' => 'Dipesan',
                'booking_date' => '2026-04-13',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'service_id' => 1,
                'schedule_id' => 1,
                'status' => 'Dibatalkan',
                'booking_date' => '2026-04-14',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
