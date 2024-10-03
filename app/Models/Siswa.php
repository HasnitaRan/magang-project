<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'user_id',
        'nama_siswa',
        'nis',
        'nisn',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'status_dalam_keluarga',
        'anak_ke',
        'asal_sekolah',
        'tahun_masuk',
        'foto_profil',
        'agama',
    ];

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama');

    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}