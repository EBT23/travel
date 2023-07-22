<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shuttle extends Model
{
    use HasFactory;
    protected $table = 'armada'; //nama tabel pada database

    protected $fillable = [ //kolom yang diizinkan diisi secara massal
        'id',
        'nopol',
        'jenis_mobil',
        'kapasitas',
    ];

    public function seats()
    {
        return $this->hasMany(Kursi::class);
    }
}
