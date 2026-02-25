<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kurir',
        'no_hp',
        'alamat',
        'status_kurir',
        'kendaraan',
        'plat_nomor',
        'catatan',
    ];
}
