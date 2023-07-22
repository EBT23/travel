<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    use HasFactory;
    protected $table = 'rute'; //nama tabel pada database

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'id',
        'keberangkatan',
        'tujuan',
        'waktu',
    ];
}
