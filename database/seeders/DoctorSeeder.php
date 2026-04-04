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
                'name' => 'Dr. Cent',
                'email' => 'cent@doc.com',
                'category_id' => 1,
            ],
            [
                'name' => 'Dr. Will',
                'email' => 'will@doc.com',
                'category_id' => 2,
            ],
            [
                'name' => 'Dr. Chris',
                'email' => 'chris@doc.com',
                'category_id' => 3,
            ],
        ]);
    }
}
