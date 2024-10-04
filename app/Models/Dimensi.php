<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimensi extends Model
{
    use HasFactory;

    protected $table = 'dimensi';

    protected $fillable = [
        'dimensi',
    ];

    public function elemen()
    {
        return $this->hasMany(Elemen::class, 'id_dimensi'); // Relasi hasMany ke model Elemen
    }
}
