<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('doctors')->insert([
            [
                'name' => 'Dr. John',
                'email' => 'john@doc.com',
                'specialization_id' => 1, 
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Cent',
                'email' => 'cent@doc.com',
                'specialization_id' => 2, 
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Sarah',
                'email' => 'sarah@doc.com',
                'specialization_id' => 3, 
                'user_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Michael',
                'email' => 'michael@doc.com',
                'specialization_id' => 4, 
                'user_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
