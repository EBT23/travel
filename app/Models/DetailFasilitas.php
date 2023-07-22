<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFasilitas extends Model
{
    use HasFactory;

    protected $table = 'detail_fasilitas'; //nama tabel pada database

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'id',
        'id_fasilitas',
        'id_armada',
    ];
}
