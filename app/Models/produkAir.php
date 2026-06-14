<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukAir extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk_air';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk',
        'jenis_kemasan',
        'kapasitas',
        'harga',
        'stok',
        'status_produk',
        'tanggal_ditambahkan',
        'foto_produk',
        'deskripsi',
    ];
}
