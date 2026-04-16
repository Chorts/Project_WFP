<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. John',
                'email' => 'doctor1@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'doctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Member User',
                'email' => 'member@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'member',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Cent',
                'email' => 'cent@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'doctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Sarah',
                'email' => 'sarah.doctor@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'doctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Michael',
                'email' => 'michael.doc@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'doctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andi Saputra',
                'email' => 'andi@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'member',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Rahma',
                'email' => 'siti@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'member',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
