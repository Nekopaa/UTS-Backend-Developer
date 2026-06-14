<?php

use App\Models\User;
use App\Models\ProdukAir;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Langganan;
use App\Models\Pengiriman;
use App\Models\Kurir;
use Carbon\Carbon;

test('authenticated user instant order assigns courier and creates shipment', function () {
    $this->withoutMiddleware();
    $user = User::factory()->create(['role' => 'user']);
    
    // Seed active courier
    $kurir = Kurir::create([
        'nama_kurir' => 'Staff Kurir Sehat',
        'status_kurir' => 'aktif',
        'no_hp' => '0811111111'
    ]);

    $produk = ProdukAir::create([
        'nama_produk' => 'Galon Sehat Rindu',
        'jenis_kemasan' => 'galon',
        'kapasitas' => '1500ml',
        'harga' => 18000.00,
        'stok' => 5,
        'status_produk' => 'tersedia',
        'tanggal_ditambahkan' => now(),
    ]);

    $response = $this->actingAs($user)->post('/orders', [
        'id_produk' => $produk->id_produk,
        'jumlah' => 1,
        'metode_pembayaran' => 'transfer',
        'no_telepon' => '081234567890',
        'alamat' => 'Jalan Indah No. 5',
        'berlangganan' => 'sekali',
        'metode_pengiriman' => 'instant',
    ]);
    $response->assertRedirect('/dashboard');
    $response->assertSessionHas('success');

    // Assert Pengiriman was created and courier was assigned
    $transaksi = Transaksi::latest()->first();
    $this->assertNotNull($transaksi);

    $pengiriman = Pengiriman::where('id_transaksi', $transaksi->id_transaksi)->first();
    $this->assertNotNull($pengiriman);
    $this->assertEquals($kurir->id_kurir, $pengiriman->id_kurir);
    $this->assertEquals('dijadwalkan', $pengiriman->status_pengiriman);
});

test('user can create smart subscription with custom schedule pre-generating shipments', function () {
    $this->withoutMiddleware();
    $user = User::factory()->create(['role' => 'user']);
    
    // Set custom date to keep tests consistent
    Carbon::setTestNow(Carbon::parse('2026-06-10 10:00:00')); // Wednesday

    $kurir = Kurir::create([
        'nama_kurir' => 'Staff Kurir Kilat',
        'status_kurir' => 'aktif',
    ]);

    $produk = ProdukAir::create([
        'nama_produk' => 'Botol Higienis Rindu',
        'jenis_kemasan' => 'botol',
        'kapasitas' => '600ml',
        'harga' => 4000.00,
        'stok' => 100,
        'status_produk' => 'tersedia',
    ]);

    // Request to active subscription for Monday & Thursday (Senin, Kamis) for 1 month
    // From June 10, 2026 (Wednesday) to July 10, 2026 is exactly 1 month.
    // Mondays in that range: June 15, 22, 29, July 6 (4 days)
    // Thursdays in that range: June 11, 18, 25, July 2, 9 (5 days)
    // Total delivery dates = 9
    $response = $this->actingAs($user)->post('/pelanggan/langganan', [
        'id_produk' => $produk->id_produk,
        'jumlah_pesanan' => 2,
        'hari_pengantaran' => ['Senin', 'Kamis'],
        'jam_pengantaran' => '09:00',
        'durasi_bulan' => 1,
        'no_telepon' => '081234567890',
        'alamat' => 'Perumahan Rindu No. 10',
        'metode_pembayaran' => 'transfer',
    ]);

    $response->assertRedirect('/dashboard');
    $response->assertSessionHas('success');

    // Assert Langganan was created
    $langganan = Langganan::latest()->first();
    $this->assertNotNull($langganan);
    $this->assertEquals('Senin,Kamis', $langganan->hari_pengantaran);
    $this->assertEquals('09:00', $langganan->jam_pengantaran);
    
    // Assert 8 transactions were pre-generated (correct 2 days * 4 weeks)
    $transaksiCount = Transaksi::where('id_langganan', $langganan->id_langganan)->count();
    $this->assertEquals(8, $transaksiCount);

    // Assert 8 shipments were pre-generated and assigned to the active courier
    $pengirimanCount = Pengiriman::whereIn('id_transaksi', function ($query) use ($langganan) {
        $query->select('id_transaksi')->from('transaksi')->where('id_langganan', $langganan->id_langganan);
    })->count();
    $this->assertEquals(8, $pengirimanCount);

    // Check first shipment date matches June 11, 2026 (Thursday) 09:00
    $firstShipment = Pengiriman::whereIn('id_transaksi', function ($query) use ($langganan) {
        $query->select('id_transaksi')->from('transaksi')->where('id_langganan', $langganan->id_langganan);
    })->orderBy('tanggal_pengiriman')->first();
    
    $this->assertEquals('2026-06-11 09:00:00', Carbon::parse($firstShipment->tanggal_pengiriman)->toDateTimeString());
    $this->assertEquals($kurir->id_kurir, $firstShipment->id_kurir);

    Carbon::setTestNow(); // Reset test time
});

test('admin can update kanban status and courier assignment via API', function () {
    $this->withoutMiddleware();
    $admin = User::factory()->create(['role' => 'admin']);
    
    $kurir = Kurir::create([
        'nama_kurir' => 'Kurir Aseli',
        'status_kurir' => 'aktif',
    ]);

    $pelanggan = Pelanggan::create([
        'nama_pelanggan' => 'Tomi',
        'penanggung_jawab' => 'Tomi',
        'jenis_pelanggan' => 'individu',
        'no_telepon' => '082222',
        'status_pelanggan' => 'aktif',
    ]);

    $transaksi = Transaksi::create([
        'id_pelanggan' => $pelanggan->id_pelanggan,
        'tanggal_transaksi' => now(),
        'metode_pembayaran' => 'transfer',
        'total_bayar' => 10000,
        'status_transaksi' => 'dibayar',
        'kode_invoice' => 'INV-TEST-KANBAN',
    ]);

    $pengiriman = Pengiriman::create([
        'id_transaksi' => $transaksi->id_transaksi,
        'id_kurir' => null,
        'alamat_tujuan' => 'Jl. Merdeka',
        'status_pengiriman' => 'dijadwalkan',
    ]);

    // 1. Test Courier Assignment
    $response = $this->actingAs($admin)->patchJson("/admin/pengiriman/{$pengiriman->id_pengiriman}/quick-update", [
        'id_kurir' => $kurir->id_kurir,
    ]);

    $response->assertStatus(200);
    $response->assertJsonPath('success', true);

    $pengiriman->refresh();
    $this->assertEquals($kurir->id_kurir, $pengiriman->id_kurir);

    // 2. Test status transition to transit
    $response = $this->actingAs($admin)->patchJson("/admin/pengiriman/{$pengiriman->id_pengiriman}/quick-update", [
        'status_pengiriman' => 'dalam perjalanan',
    ]);

    $response->assertStatus(200);
    $pengiriman->refresh();
    $this->assertEquals('dalam perjalanan', $pengiriman->status_pengiriman);

    // 3. Test status transition to delivered (terkirim) - should auto-complete transaction
    $response = $this->actingAs($admin)->patchJson("/admin/pengiriman/{$pengiriman->id_pengiriman}/quick-update", [
        'status_pengiriman' => 'terkirim',
    ]);

    $response->assertStatus(200);
    $pengiriman->refresh();
    $transaksi->refresh();

    $this->assertEquals('terkirim', $pengiriman->status_pengiriman);
    $this->assertEquals('selesai', $transaksi->status_transaksi);
});
