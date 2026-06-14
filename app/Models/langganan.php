<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langganan extends Model
{
    use HasFactory;

    protected $table = 'langganan';
    protected $primaryKey = 'id_langganan';

    protected $fillable = [
        'id_pelanggan',
        'id_produk',
        'periode_pengantaran',
        'tanggal_mulai',
        'tanggal_berakhir',
        'jumlah_pesanan',
        'status_langganan',
        'hari_pengantaran',
        'jam_pengantaran',
        'durasi_bulan',
    ];

    public function produk()
    {
        return $this->belongsTo(ProdukAir::class, 'id_produk', 'id_produk');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_langganan', 'id_langganan');
    }
}
