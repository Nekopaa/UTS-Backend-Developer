<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggan extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'jenis_pelanggan',
        'nama_pelanggan',
        'nama_lembaga',
        'penanggung_jawab',
        'alamat',
        'no_telepon',
        'email',
        'tanggal_daftar',
        'status_pelanggan',
    ];
}
