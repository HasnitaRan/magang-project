<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sekolah')->insert([
            'nama_sekolah' => 'SMAN 1 Tegal',
            'npsn' => '12345678',
            'jalan' => 'Jl. Merdeka No. 1',
            'desa_kelurahan' => 'Merdeka',
            'kecamatan' => 'Tegal Barat',
            'kabupaten' => 'Tegal',
            'provinsi' => 'Jawa Tengah',
            'kode_pos' => '52112',
            'no_telp' => '02833456789',
            'website' => 'www.sman1tegal.sch.id',
            'email' => 'info@sman1tegal.sch.id',
            'kepala_sekolah' => 'Budi Santoso',
            'nip_kepsek' => '196010101988011001',
            'logo_sekolah' => 'logo_sman1tegal.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}