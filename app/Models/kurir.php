<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kurir extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'kurir';
    protected $primaryKey = 'id_kurir';

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
