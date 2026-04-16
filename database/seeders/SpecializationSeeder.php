<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->insert([
            [
                'name' => 'Jantung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kulit & Kelamin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anak (Pediatri)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Saraf (Neurologi)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Penyakit Dalam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
