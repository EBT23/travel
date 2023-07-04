<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursi extends Model
{
    use HasFactory;
    protected $table = 'kursi';
    protected $fillable = [
        'id_tiket',
        'id_mobil',
        'no_kursi',
        'is_booked',
    ];

    public function car()
    {
        return $this->belongsTo(Shuttle::class);
    }
}
