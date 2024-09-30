<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'sekolah';

    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'jalan',
        'desa_kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'no_telp',
        'website',
        'email',
        'kepala_sekolah',
        'nip_kepsek',
        'logo_sekolah',
    ];
}

