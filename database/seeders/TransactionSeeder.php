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
                'patient_name' => 'Vincent',
                'doctor_id' => 1,
                'service_id' => 1,
                'status' => 'Lunas',
                'price' => 100000,
                'transaction_date' => now(),
            ],
        ]);
    }
}