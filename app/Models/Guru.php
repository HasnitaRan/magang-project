<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'user_id',
        'nama_guru',
        'jenis_kelamin',
        'nip',
        'tempat_lahir',
        'tgl_lahir',
        'no_hp',
        'alamat',
        'foto_profil',
        'agama_id',
    ];

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id');

    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}