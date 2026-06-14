<?php
$transaksis = \App\Models\Transaksi::where('status_transaksi', 'selesai')->get();
if ($transaksis->count() > 0) {
    \App\Models\LaporanPenjualan::updateOrCreate(
        ['periode_laporan' => 'bulanan'],
        [
            'total_transaksi' => $transaksis->count(),
            'total_pendapatan' => $transaksis->sum('total_bayar'),
            'produk_terlaris' => 'Air Mineral',
            'tanggal_dibuat' => now(),
        ]
    );
    echo "Generated report for bulanan.";
} else {
    echo "No selesai transactions found.";
}
