<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('transactions')->insert([
            [
                'booking_id' => 1,
                'status' => 'Lunas',
                'price' => 50000,
                'transaction_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'status' => 'Lunas',
                'price' => 50000,
                'transaction_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 3,
                'status' => 'Menunggu Pembayaran',
                'price' => 75000,
                'transaction_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 4,
                'status' => 'Menunggu Pembayaran',
                'price' => 75000,
                'transaction_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 5,
                'status' => 'Dibatalkan',
                'price' => 50000,
                'transaction_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}