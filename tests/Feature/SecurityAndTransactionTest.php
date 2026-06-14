<?php

use App\Models\User;
use App\Models\ProdukAir;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Langganan;
use App\Models\DetailPesanan;

test('guest cannot access dashboard', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('user cannot access admin dashboard', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $response = $this->actingAs($user)->get('/admin/dashboard');
    $response->assertStatus(403);
});

test('admin can access admin dashboard', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->actingAs($admin)->get('/admin/dashboard');
    $response->assertStatus(200);
});

test('admin registration with correct secret code passes', function () {
    $this->withoutMiddleware();
    $response = $this->post('/register', [
        'name' => 'Admin User',
        'email' => 'admin@rinduwater.co.id',
        'role' => 'admin',
        'company_code' => 'PRIMA',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $this->assertAuthenticated();
    $this->assertEquals('admin', auth()->user()->role);
    $response->assertRedirect('/admin/dashboard');
});

test('admin registration with incorrect secret code fails', function () {
    $this->withoutMiddleware();
    $response = $this->post('/register', [
        'name' => 'Admin User Fake',
        'email' => 'fakeadmin@rinduwater.co.id',
        'role' => 'admin',
        'company_code' => 'WRONG_CODE',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertSessionHasErrors(['company_code']);
    $this->assertGuest();
});

test('authenticated user can place a regular order', function () {
    $this->withoutMiddleware();
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $produk = ProdukAir::create([
        'nama_produk' => 'Galon Rindu Sehat',
        'jenis_kemasan' => 'galon',
        'kapasitas' => '1500ml',
        'harga' => 20000.00,
        'stok' => 10,
        'status_produk' => 'tersedia',
        'tanggal_ditambahkan' => now(),
    ]);

    $response = $this->actingAs($user)->post('/orders', [
        'id_produk' => $produk->id_produk,
        'jumlah' => 2,
        'metode_pembayaran' => 'transfer',
        'no_telepon' => '081234567890',
        'alamat' => 'Jalan Sehat No. 42',
        'catatan' => 'Kirim siang hari',
        'berlangganan' => 'sekali',
        'metode_pengiriman' => 'instant',
    ]);

    // Check redirection & success session
    $response->assertRedirect('/dashboard');
    $response->assertSessionHas('success');

    // Check product stock decremented
    $produk->refresh();
    $this->assertEquals(8, $produk->stok);

    // Check Pelanggan created/updated
    $pelanggan = Pelanggan::where('email', $user->email)->first();
    $this->assertNotNull($pelanggan);
    $this->assertEquals('Jalan Sehat No. 42', $pelanggan->alamat);

    // Check Transaksi created
    $transaksi = Transaksi::where('id_pelanggan', $pelanggan->id_pelanggan)->first();
    $this->assertNotNull($transaksi);
    // 20000 * 2 + 25000 (instant shipping) = 65000
    $this->assertEquals(65000.00, $transaksi->total_bayar);
    $this->assertEquals('dibayar', $transaksi->status_transaksi);

    // Check DetailPesanan created
    $detail = DetailPesanan::where('id_transaksi', $transaksi->id_transaksi)->first();
    $this->assertNotNull($detail);
    $this->assertEquals($produk->id_produk, $detail->id_produk);
    $this->assertEquals(2, $detail->jumlah);
});

test('user cannot place order with insufficient stock', function () {
    $this->withoutMiddleware();
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $produk = ProdukAir::create([
        'nama_produk' => 'Galon Rindu Sehat',
        'jenis_kemasan' => 'galon',
        'kapasitas' => '1500ml',
        'harga' => 20000.00,
        'stok' => 1,
        'status_produk' => 'tersedia',
        'tanggal_ditambahkan' => now(),
    ]);

    $response = $this->actingAs($user)->from('/dashboard')->post('/orders', [
        'id_produk' => $produk->id_produk,
        'jumlah' => 2,
        'metode_pembayaran' => 'transfer',
        'no_telepon' => '081234567890',
        'alamat' => 'Jalan Sehat No. 42',
        'berlangganan' => 'sekali',
        'metode_pengiriman' => 'instant',
    ]);

    $response->assertRedirect('/dashboard');
    $response->assertSessionHas('error', 'Stok produk tidak mencukupi untuk jumlah pesanan Anda.');

    // Check stock remains unchanged
    $produk->refresh();
    $this->assertEquals(1, $produk->stok);
});

test('authenticated user can place a subscription order', function () {
    $this->withoutMiddleware();
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $produk = ProdukAir::create([
        'nama_produk' => 'Galon Rindu Sehat',
        'jenis_kemasan' => 'galon',
        'kapasitas' => '1500ml',
        'harga' => 20000.00,
        'stok' => 10,
        'status_produk' => 'tersedia',
        'tanggal_ditambahkan' => now(),
    ]);

    $response = $this->actingAs($user)->post('/orders', [
        'id_produk' => $produk->id_produk,
        'jumlah' => 1,
        'metode_pembayaran' => 'transfer',
        'no_telepon' => '081234567890',
        'alamat' => 'Jalan Sehat No. 42',
        'berlangganan' => 'mingguan',
        'tanggal_mulai' => now()->format('Y-m-d'),
        'metode_pengiriman' => 'instant',
    ]);

    $response->assertRedirect('/dashboard');
    $response->assertSessionHas('success');

    // Check subscription created
    $pelanggan = Pelanggan::where('email', $user->email)->first();
    $langganan = Langganan::where('id_pelanggan', $pelanggan->id_pelanggan)->first();
    $this->assertNotNull($langganan);
    $this->assertEquals('mingguan', $langganan->periode_pengantaran);
    $this->assertEquals('aktif', $langganan->status_langganan);

    // Check Transaksi linked to subscription
    $transaksi = Transaksi::where('id_pelanggan', $pelanggan->id_pelanggan)->first();
    $this->assertEquals($langganan->id_langganan, $transaksi->id_langganan);
});

test('admin can cancel transaction and restore product stock', function () {
    $this->withoutMiddleware();
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $produk = ProdukAir::create([
        'nama_produk' => 'Air Restock Test',
        'jenis_kemasan' => 'galon',
        'kapasitas' => '19L',
        'harga' => 15000.00,
        'stok' => 5,
        'status_produk' => 'tersedia',
        'tanggal_ditambahkan' => now(),
    ]);

    $pelanggan = Pelanggan::create([
        'nama_pelanggan' => 'Test Pelanggan',
        'jenis_pelanggan' => 'individu',
        'no_telepon' => '081234567891',
        'alamat' => 'Jalan Melati 10',
        'status_pelanggan' => 'aktif',
        'penanggung_jawab' => 'Test Pelanggan',
    ]);

    $transaksi = Transaksi::create([
        'id_pelanggan' => $pelanggan->id_pelanggan,
        'tanggal_transaksi' => now(),
        'metode_pembayaran' => 'transfer',
        'total_bayar' => 30000.00,
        'status_transaksi' => 'menunggu',
        'kode_invoice' => 'INV-TEST-001',
    ]);

    DetailPesanan::create([
        'id_transaksi' => $transaksi->id_transaksi,
        'id_produk' => $produk->id_produk,
        'jumlah' => 2,
        'harga_satuan' => 15000.00,
    ]);

    // Perform PUT update to cancel transaction
    $response = $this->actingAs($admin)->put("/transaksi/{$transaksi->id_transaksi}", [
        'status_transaksi' => 'dibatalkan',
    ]);

    $response->assertRedirect(route('transaksi.index'));
    
    // Check product stock has incremented by 2
    $produk->refresh();
    $this->assertEquals(7, $produk->stok);
});
