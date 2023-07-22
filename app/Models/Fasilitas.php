<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas'; //nama tabel pada database

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'id',
        'nama_fasilitas',
    ];
}
