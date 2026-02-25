<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_perubahan',
        'jumlah',
        'tanggal_perubahan',
        'keterangan',
    ];
}
