<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status_aktif' => 'aktif',
            ],
            [
                'username' => 'guru1',
                'email' => 'guru1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
                'status_aktif' => 'aktif',
            ],
            [
                'username' => 'siswa1',
                'email' => 'siswa1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'status_aktif' => 'aktif',
            ],
            [
                'username' => 'guru2',
                'email' => 'guru2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
                'status_aktif' => 'nonaktif',
            ]
        ]);
    }
}
