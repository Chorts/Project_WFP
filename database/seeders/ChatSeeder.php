<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('chats')->insert([
            [
                'booking_id' => 1,
                'sender_id' => 3, 
                'tipe_sender' => 'user',
                'chat' => 'Halo dok, saya merasa pusing sejak kemarin.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 1,
                'sender_id' => 2, 
                'tipe_sender' => 'doctor',
                'chat' => 'Apakah disertai demam atau mual?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'sender_id' => 7, 
                'tipe_sender' => 'user',
                'chat' => 'Dok, saya batuk sudah 3 hari.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'sender_id' => 4, 
                'tipe_sender' => 'doctor',
                'chat' => 'Apakah ada riwayat alergi?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 3,
                'sender_id' => 8,
                'tipe_sender' => 'user',
                'chat' => 'Saya mengalami nyeri di bagian perut.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 4,
                'sender_id' => 3,
                'tipe_sender' => 'user',
                'chat' => 'Dok, berapa kali sehari harus minum obat ini?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
