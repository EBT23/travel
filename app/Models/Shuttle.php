<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shuttle extends Model
{
    use HasFactory;
    protected $table = 'shuttle'; //nama tabel pada database

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'id',
        'jenis_mobil',
        'kapasitas',
        'fasilitas',
    ];

    public function seats()
    {
        return $this->hasMany(Kursi::class);
    }
}
