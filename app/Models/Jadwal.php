<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal_keberangkatan';
    protected $fillable = [
        'id',
        'tgl_keberangkatan',
        'id_armada',
        'rute',
        'id_user',
        'estimasi_perjalanan',
        'harga',
    ];
}
