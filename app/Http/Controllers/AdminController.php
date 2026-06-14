<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Transaksi;
use App\Models\Langganan;
use App\Models\ProdukAir;
use App\Models\Pelanggan;
use App\Models\Kurir;
use App\Models\Pengiriman;
use App\Models\Gudang;
use App\Models\LaporanPenjualan;
use App\Models\RiwayatStock;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalTransaksi = Transaksi::count();
        $totalPendapatan = Transaksi::whereIn('status_transaksi', ['dibayar', 'dikirim', 'selesai'])->sum('total_bayar');
        $totalLangganan = Langganan::where('status_langganan', 'aktif')->count();
        $totalPelanggan = Pelanggan::count();
        
        $lowStockProducts = ProdukAir::where('stok', '<', 15)->get();
        $activeShipments = Pengiriman::whereIn('status_pengiriman', ['dijadwalkan', 'dalam perjalanan'])->count();
        
        $recentTransactions = Transaksi::with('pelanggan')->latest()->take(5)->get();
        $recentShipments = Pengiriman::with(['transaksi.pelanggan', 'kurir'])->latest()->take(5)->get();
        $stockHistory = RiwayatStock::latest()->take(5)->get();

        // New Kanban & KPI Stats
        $incomingOrdersToday = Transaksi::whereDate('tanggal_transaksi', \Carbon\Carbon::today())->count();
        $activeCouriersCount = Kurir::where('status_kurir', 'aktif')->count();
        $totalRevenue = Transaksi::whereIn('status_transaksi', ['dibayar', 'selesai'])->sum('total_bayar');
        $criticalStockCount = ProdukAir::where('stok', '<', 15)->count();

        $allShipments = Pengiriman::with(['transaksi.pelanggan', 'transaksi.detailPesanan.produk', 'kurir'])->get();

        $menungguShipments = $allShipments->filter(function ($s) {
            return $s->status_pengiriman === 'dijadwalkan' && is_null($s->id_kurir);
        });

        $diprosesShipments = $allShipments->filter(function ($s) {
            return $s->status_pengiriman === 'dijadwalkan' && !is_null($s->id_kurir);
        });

        $dijalanShipments = $allShipments->filter(function ($s) {
            return $s->status_pengiriman === 'dalam perjalanan';
        });

        $selesaiShipments = $allShipments->filter(function ($s) {
            return $s->status_pengiriman === 'terkirim';
        });

        $activeCouriers = Kurir::where('status_kurir', 'aktif')->get();

        return view('admin.dashboard', compact(
            'totalTransaksi',
            'totalPendapatan',
            'totalLangganan',
            'totalPelanggan',
            'lowStockProducts',
            'activeShipments',
            'recentTransactions',
            'recentShipments',
            'stockHistory',
            'incomingOrdersToday',
            'activeCouriersCount',
            'totalRevenue',
            'criticalStockCount',
            'menungguShipments',
            'diprosesShipments',
            'dijalanShipments',
            'selesaiShipments',
            'activeCouriers'
        ));
    }

    public function index()
    {
        $admin = Admin::all();
        return view('admin.index', compact('admin'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|unique:admin,username',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:admin,email',
            'no_hp' => 'required|string',
            'role' => 'required|string',
            'status_admin' => 'required|string',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated) {
            \App\Models\Admin::create($validated);
            
            \App\Models\User::create([
                'name' => $validated['nama_admin'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => 'admin',
            ]);
        });

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|unique:admin,username,' . $id . ',id_admin',
            'email' => 'required|email|unique:admin,email,' . $id . ',id_admin',
            'no_hp' => 'required|string',
            'role' => 'required|string',
            'status_admin' => 'required|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $admin->update($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diupdate');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus');
    }
}
