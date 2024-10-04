<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemen extends Model
{
    use HasFactory;

    protected $table = 'elemen'; // Pastikan nama tabel sesuai dengan yang ada di database

    protected $fillable = [
        'elemen', 'id_dimensi',
    ];

    // Relasi ke model Dimensi
    public function dimensi()
    {
        return $this->belongsTo(Dimensi::class, 'id_dimensi'); // Pastikan id_dimensi adalah foreign key yang benar
    }
}
