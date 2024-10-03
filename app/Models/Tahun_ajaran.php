<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun_ajaran extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id_tahunAjaran';

    protected $fillable = [
        'tahun_ajaran',
        'semester',
    ];

}