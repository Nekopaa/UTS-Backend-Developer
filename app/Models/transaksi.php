<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_pelanggan',
        'id_langganan',
        'tanggal_transaksi',
        'metode_pembayaran',
        'total_bayar',
        'status_transaksi',
        'kode_invoice',
        'catatan',
        'metode_pengiriman',
        'biaya_pengiriman',
    ];

    public function detailPesanan()
    {
        return $this->hasOne(DetailPesanan::class, 'id_transaksi', 'id_transaksi');
    }
    
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class, 'id_transaksi', 'id_transaksi');
    }
}
