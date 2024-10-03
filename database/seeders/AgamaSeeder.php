<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('agama')->insert([
            ['agama' => 'Islam'],
            ['agama' => 'Kristen'],
            ['agama' => 'Katolik'],
            ['agama' => 'Hindu'],
            ['agama' => 'Buddha'],
            ['agama' => 'Konghucu'],
        ]);
    }

}