<?php

use App\Models\User;
use App\Models\Admin;
use App\Models\Gudang;
use App\Models\Kurir;
use App\Models\ProdukAir;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Langganan;
use App\Models\Pengiriman;
use App\Models\RiwayatStock;
use App\Models\LaporanPenjualan;

/*
|--------------------------------------------------------------------------
| Admin Dashboard & Metrics Tests
|--------------------------------------------------------------------------
*/

test('admin can access dashboard and view correct KPI metrics', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    // Seed some related records for dashboard statistics
    $produk = ProdukAir::create([
        'nama_produk' => 'Rindu Galon 19L',
        'jenis_kemasan' => 'galon',
        'kapasitas' => '19L',
        'harga' => 20000,
        'stok' => 5, // low stock (under 15) to trigger KPI alert
        'status_produk' => 'tersedia',
    ]);

    $pelanggan = Pelanggan::create([
        'nama_pelanggan' => 'John Doe',
        'email' => 'john@example.com',
        'no_telepon' => '0812345678',
        'alamat' => 'Jalan Merdeka',
        'penanggung_jawab' => 'John',
        'jenis_pelanggan' => 'individu',
    ]);

    $transaksi = Transaksi::create([
        'id_pelanggan' => $pelanggan->id_pelanggan,
        'tanggal_transaksi' => now(),
        'metode_pembayaran' => 'transfer',
        'total_bayar' => 45000,
        'status_transaksi' => 'dibayar',
        'kode_invoice' => 'INV-TEST-1',
        'metode_pengiriman' => 'standart',
        'biaya_pengiriman' => 5000,
    ]);

    $kurir = Kurir::create([
        'nama_kurir' => 'Kurir Cepat',
        'no_hp' => '089999999',
        'alamat' => 'Alamat Kurir',
        'status_kurir' => 'aktif',
        'kendaraan' => 'motor',
        'plat_nomor' => 'AD 1234 AB',
    ]);

    $pengiriman = Pengiriman::create([
        'id_transaksi' => $transaksi->id_transaksi,
        'id_kurir' => null,
        'alamat_tujuan' => 'Jalan Merdeka',
        'tanggal_pengiriman' => now()->addDay(),
        'status_pengiriman' => 'dijadwalkan',
    ]);

    $response = $this->actingAs($admin)->get('/admin/dashboard');

    $response->assertStatus(200);
    $response->assertSee('Rindu Galon 19L'); // Sees low stock product name
    $response->assertSee('Rp 45.000'); // Sees revenue in metric card
    $response->assertSee('1 Orang'); // Active courier count
});

/*
|--------------------------------------------------------------------------
| Admin Staff (AdminController) CRUD Tests
|--------------------------------------------------------------------------
*/

test('admin can manage administrative staff (Admin Controller CRUD)', function () {
    $adminUser = User::factory()->create(['role' => 'admin']);

    // 1. Index Page
    $response = $this->actingAs($adminUser)->get('/admin/admin');
    $response->assertStatus(200);

    // 2. Create Page
    $response = $this->actingAs($adminUser)->get('/admin/admin/create');
    $response->assertStatus(200);

    // 3. Store Staff (hashes password correctly)
    $response = $this->actingAs($adminUser)->post('/admin/admin', [
        'nama_admin' => 'Staff Heri',
        'username' => 'heri_staff_99',
        'password' => 'secret123',
        'email' => 'heri@rinduwater.com',
        'no_hp' => '081234567890',
        'role' => 'staff',
        'status_admin' => 'aktif',
    ]);
    $response->assertRedirect('/admin/admin');
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('admin', [
        'nama_admin' => 'Staff Heri',
        'username' => 'heri_staff_99',
        'email' => 'heri@rinduwater.com',
        'role' => 'staff',
        'status_admin' => 'aktif',
    ]);

    $createdStaff = Admin::where('username', 'heri_staff_99')->first();
    $this->assertNotEquals('secret123', $createdStaff->password); // verified hashed

    // 4. Edit Page
    $response = $this->actingAs($adminUser)->get("/admin/admin/{$createdStaff->id_admin}/edit");
    $response->assertStatus(200);

    // 5. Update Staff
    $response = $this->actingAs($adminUser)->put("/admin/admin/{$createdStaff->id_admin}", [
        'nama_admin' => 'Staff Heri Edited',
        'username' => 'heri_staff_99',
        'email' => 'heri_edited@rinduwater.com',
        'no_hp' => '081234567890',
        'role' => 'staff',
        'status_admin' => 'nonaktif',
    ]);
    $response->assertRedirect('/admin/admin');
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('admin', [
        'id_admin' => $createdStaff->id_admin,
        'nama_admin' => 'Staff Heri Edited',
        'email' => 'heri_edited@rinduwater.com',
        'status_admin' => 'nonaktif',
    ]);

    // 6. Delete Staff
    $response = $this->actingAs($adminUser)->delete("/admin/admin/{$createdStaff->id_admin}");
    $response->assertRedirect('/admin/admin');
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('admin', [
        'id_admin' => $createdStaff->id_admin,
    ]);
});

/*
|--------------------------------------------------------------------------
| User Management (UserController) CRUD Tests
|--------------------------------------------------------------------------
*/

test('admin can manage users (UserController CRUD)', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    // 1. Index
    $response = $this->actingAs($admin)->get('/admin/users');
    $response->assertStatus(200);

    // 2. Create
    $response = $this->actingAs($admin)->get('/admin/users/create');
    $response->assertStatus(200);

    // 3. Store
    $response = $this->actingAs($admin)->post('/admin/users', [
        'name' => 'Buyer Account',
        'email' => 'buyer@gmail.com',
        'password' => 'buyerpassword',
        'password_confirmation' => 'buyerpassword',
    ]);
    $response->assertRedirect('/admin/users');

    $this->assertDatabaseHas('users', [
        'name' => 'Buyer Account',
        'email' => 'buyer@gmail.com',
    ]);

    $user = User::where('email', 'buyer@gmail.com')->first();

    // 4. Edit
    $response = $this->actingAs($admin)->get("/admin/users/{$user->id}/edit");
    $response->assertStatus(200);

    // 5. Update
    $response = $this->actingAs($admin)->put("/admin/users/{$user->id}", [
        'name' => 'Buyer Account Updated',
        'email' => 'buyer_new@gmail.com',
    ]);
    $response->assertRedirect('/admin/users');

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Buyer Account Updated',
        'email' => 'buyer_new@gmail.com',
    ]);

    // 6. Destroy
    $response = $this->actingAs($admin)->delete("/admin/users/{$user->id}");
    $response->assertRedirect('/admin/users');
    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

/*
|--------------------------------------------------------------------------
| Gudang Management (GudangController) CRUD Tests
|--------------------------------------------------------------------------
*/

test('admin can manage warehouses (GudangController CRUD)', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    // 1. Store (including validation check with penuh status)
    $response = $this->actingAs($admin)->post('/admin/gudang', [
        'nama_gudang' => 'Gudang Jogja',
        'lokasi' => 'Jalan Malioboro No. 10',
        'kapasitas_total' => 500,
        'stok_saat_ini' => 500,
        'status_gudang' => 'penuh', // checks that penuh is successfully accepted now
    ]);
    $response->assertRedirect('/admin/gudang');
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('gudang', [
        'nama_gudang' => 'Gudang Jogja',
        'status_gudang' => 'penuh',
    ]);

    $gudang = Gudang::where('nama_gudang', 'Gudang Jogja')->first();

    // 2. Update
    $response = $this->actingAs($admin)->put("/admin/gudang/{$gudang->id_gudang}", [
        'nama_gudang' => 'Gudang Jogja Utama',
        'lokasi' => 'Jalan Malioboro No. 10',
        'kapasitas_total' => 600,
        'stok_saat_ini' => 100,
        'status_gudang' => 'aktif',
    ]);
    $response->assertRedirect('/admin/gudang');

    $this->assertDatabaseHas('gudang', [
        'id_gudang' => $gudang->id_gudang,
        'nama_gudang' => 'Gudang Jogja Utama',
        'status_gudang' => 'aktif',
        'stok_saat_ini' => 100,
    ]);

    // 3. Destroy
    $response = $this->actingAs($admin)->delete("/admin/gudang/{$gudang->id_gudang}");
    $response->assertRedirect('/admin/gudang');
    $this->assertDatabaseMissing('gudang', ['id_gudang' => $gudang->id_gudang]);
});

/*
|--------------------------------------------------------------------------
| Kurir Management (KurirController) CRUD Tests
|--------------------------------------------------------------------------
*/

test('admin can manage couriers (KurirController CRUD)', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    // 1. Store
    $response = $this->actingAs($admin)->post('/admin/kurir', [
        'nama_kurir' => 'Budi Transport',
        'no_hp' => '085544332211',
        'alamat' => 'Sleman, DIY',
        'status_kurir' => 'aktif',
        'kendaraan' => 'mobil box',
        'plat_nomor' => 'AB 9999 CD',
        'catatan' => 'Sedia kirim galon besar',
    ]);
    $response->assertRedirect('/admin/kurir');

    $this->assertDatabaseHas('kurir', [
        'nama_kurir' => 'Budi Transport',
        'status_kurir' => 'aktif',
        'plat_nomor' => 'AB 9999 CD',
    ]);

    $kurir = Kurir::where('nama_kurir', 'Budi Transport')->first();

    // 2. Update
    $response = $this->actingAs($admin)->put("/admin/kurir/{$kurir->id_kurir}", [
        'nama_kurir' => 'Budi Transport Updated',
        'no_hp' => '085544332211',
        'alamat' => 'Sleman, DIY',
        'status_kurir' => 'nonaktif',
        'kendaraan' => 'mobil box',
        'plat_nomor' => 'AB 9999 CD',
        'catatan' => 'Sedang libur',
    ]);
    $response->assertRedirect('/admin/kurir');

    $this->assertDatabaseHas('kurir', [
        'id_kurir' => $kurir->id_kurir,
        'nama_kurir' => 'Budi Transport Updated',
        'status_kurir' => 'nonaktif',
    ]);

    // 3. Destroy
    $response = $this->actingAs($admin)->delete("/admin/kurir/{$kurir->id_kurir}");
    $response->assertRedirect('/admin/kurir');
    $this->assertSoftDeleted('kurir', ['id_kurir' => $kurir->id_kurir]);
});

test('admin cannot create courier with duplicate phone number or plate number unless soft deleted', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $kurir1 = Kurir::create([
        'nama_kurir' => 'Kurir A',
        'no_hp' => '08123456789',
        'alamat' => 'Alamat A',
        'status_kurir' => 'aktif',
        'kendaraan' => 'Motor',
        'plat_nomor' => 'B 1234 ABC',
    ]);

    // Attempt to create courier with same no_hp
    $response = $this->actingAs($admin)->post('/admin/kurir', [
        'nama_kurir' => 'Kurir B',
        'no_hp' => '08123456789',
        'alamat' => 'Alamat B',
        'status_kurir' => 'aktif',
        'kendaraan' => 'Motor',
        'plat_nomor' => 'B 5678 DEF',
    ]);
    $response->assertSessionHasErrors(['no_hp' => 'Nomor HP sudah terdaftar untuk kurir lain.']);

    // Attempt to create courier with same plat_nomor
    $response = $this->actingAs($admin)->post('/admin/kurir', [
        'nama_kurir' => 'Kurir C',
        'no_hp' => '08987654321',
        'alamat' => 'Alamat C',
        'status_kurir' => 'aktif',
        'kendaraan' => 'Motor',
        'plat_nomor' => 'B 1234 ABC',
    ]);
    $response->assertSessionHasErrors(['plat_nomor' => 'Plat nomor kendaraan sudah terdaftar untuk kurir lain.']);

    // Soft delete kurir1
    $kurir1->delete();

    // Now storing the same no_hp and plat_nomor should succeed
    $response = $this->actingAs($admin)->post('/admin/kurir', [
        'nama_kurir' => 'Kurir D',
        'no_hp' => '08123456789',
        'alamat' => 'Alamat D',
        'status_kurir' => 'aktif',
        'kendaraan' => 'Motor',
        'plat_nomor' => 'B 1234 ABC',
    ]);
    $response->assertRedirect('/admin/kurir');
});

test('admin cannot update courier to duplicate phone number or plate number unless soft deleted', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $kurir1 = Kurir::create([
        'nama_kurir' => 'Kurir A',
        'no_hp' => '08123456789',
        'alamat' => 'Alamat A',
        'status_kurir' => 'aktif',
        'kendaraan' => 'Motor',
        'plat_nomor' => 'B 1234 ABC',
    ]);

    $kurir2 = Kurir::create([
        'nama_kurir' => 'Kurir B',
        'no_hp' => '08987654321',
        'alamat' => 'Alamat B',
        'status_kurir' => 'aktif',
        'kendaraan' => 'Motor',
        'plat_nomor' => 'B 5678 DEF',
    ]);

    // Updating kurir2 to the same no_hp as kurir1 should fail
    $response = $this->actingAs($admin)->put("/admin/kurir/{$kurir2->id_kurir}", [
        'nama_kurir' => 'Kurir B Updated',
        'no_hp' => '08123456789',
        'alamat' => 'Alamat B',
        'status_kurir' => 'aktif',
        'kendaraan' => 'Motor',
        'plat_nomor' => 'B 5678 DEF',
    ]);
    $response->assertSessionHasErrors(['no_hp' => 'Nomor HP sudah terdaftar untuk kurir lain.']);

    // Updating kurir2 to the same plat_nomor as kurir1 should fail
    $response = $this->actingAs($admin)->put("/admin/kurir/{$kurir2->id_kurir}", [
        'nama_kurir' => 'Kurir B Updated',
        'no_hp' => '08987654321',
        'alamat' => 'Alamat B',
        'status_kurir' => 'aktif',
        'kendaraan' => 'Motor',
        'plat_nomor' => 'B 1234 ABC',
    ]);
    $response->assertSessionHasErrors(['plat_nomor' => 'Plat nomor kendaraan sudah terdaftar untuk kurir lain.']);

    // Updating kurir2 using its own current no_hp and plat_nomor should succeed (ignore current courier id)
    $response = $this->actingAs($admin)->put("/admin/kurir/{$kurir2->id_kurir}", [
        'nama_kurir' => 'Kurir B Updated',
        'no_hp' => '08987654321',
        'alamat' => 'Alamat B',
        'status_kurir' => 'aktif',
        'kendaraan' => 'Motor',
        'plat_nomor' => 'B 5678 DEF',
    ]);
    $response->assertRedirect('/admin/kurir');
});


/*
|--------------------------------------------------------------------------
| Riwayat Stock & Laporan Penjualan Tests
|--------------------------------------------------------------------------
*/

test('admin can view stock mutations and financial reports logs', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $produk = ProdukAir::create([
        'nama_produk' => 'Rindu Gelas',
        'jenis_kemasan' => 'gelas',
        'kapasitas' => '220ml',
        'harga' => 1000,
        'stok' => 50,
        'status_produk' => 'tersedia',
    ]);

    // Create a stock mutation
    $riwayat = RiwayatStock::create([
        'id_produk' => $produk->id_produk,
        'jenis_perubahan' => 'masuk',
        'jumlah' => 10,
        'tanggal_perubahan' => now(),
        'keterangan' => 'Restock supplier A',
    ]);

    // Create a sales report
    $laporan = LaporanPenjualan::create([
        'periode_laporan' => 'bulanan',
        'total_transaksi' => 12,
        'total_pendapatan' => 500000.00,
        'produk_terlaris' => 'Rindu Galon 19L',
        'tanggal_dibuat' => now(),
    ]);

    // Stock Mutation index & show
    $response = $this->actingAs($admin)->get('/admin/riwayat-stock');
    $response->assertStatus(200);
    $response->assertSee('Rindu Gelas');
    $response->assertSee('Restock supplier A');

    $response = $this->actingAs($admin)->get("/admin/riwayat-stock/{$riwayat->id_riwayat}");
    $response->assertStatus(200);
    $response->assertSee('Restock supplier A');

    // Sales Report index & show
    $response = $this->actingAs($admin)->get('/admin/laporan-penjualan');
    $response->assertStatus(200);
    $response->assertSee('Rp 500.000');

    $response = $this->actingAs($admin)->get("/admin/laporan-penjualan/{$laporan->id_laporan}");
    $response->assertStatus(200);
    $response->assertSee('bulanan');
    $response->assertSee('Rindu Galon 19L');
});

/*
|--------------------------------------------------------------------------
| Subscriptions (LanggananController) Tests
|--------------------------------------------------------------------------
*/

test('admin can view and update subscriptions', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $produk = ProdukAir::create([
        'nama_produk' => 'Rindu Botol 600ml',
        'jenis_kemasan' => 'botol',
        'kapasitas' => '600ml',
        'harga' => 3000,
        'stok' => 200,
        'status_produk' => 'tersedia',
    ]);

    $pelanggan = Pelanggan::create([
        'nama_pelanggan' => 'Alice Langganan',
        'email' => 'alice@sub.com',
        'no_telepon' => '082211',
        'alamat' => 'Malang',
        'penanggung_jawab' => 'Alice',
        'jenis_pelanggan' => 'individu',
    ]);

    $langganan = Langganan::create([
        'id_pelanggan' => $pelanggan->id_pelanggan,
        'id_produk' => $produk->id_produk,
        'periode_pengantaran' => 'mingguan',
        'tanggal_mulai' => now()->format('Y-m-d'),
        'tanggal_berakhir' => now()->addMonth()->format('Y-m-d'),
        'jumlah_pesanan' => 5,
        'status_langganan' => 'aktif',
    ]);

    // Admin index view
    $response = $this->actingAs($admin)->get('/admin/langganan');
    $response->assertStatus(200);
    $response->assertSee('Alice Langganan');

    // Admin edit view
    $response = $this->actingAs($admin)->get("/admin/langganan/{$langganan->id_langganan}/edit");
    $response->assertStatus(200);

    // Admin update subscription status
    $response = $this->actingAs($admin)->put("/admin/langganan/{$langganan->id_langganan}", [
        'id_pelanggan' => $pelanggan->id_pelanggan,
        'id_produk' => $produk->id_produk,
        'periode_pengantaran' => 'bulanan',
        'tanggal_mulai' => now()->format('Y-m-d'),
        'tanggal_berakhir' => now()->addMonth()->format('Y-m-d'),
        'jumlah_pesanan' => 10,
        'status_langganan' => 'tertunda',
    ]);
    $response->assertRedirect('/admin/langganan');

    $this->assertDatabaseHas('langganan', [
        'id_langganan' => $langganan->id_langganan,
        'periode_pengantaran' => 'bulanan',
        'jumlah_pesanan' => 10,
        'status_langganan' => 'tertunda',
    ]);
});

/*
|--------------------------------------------------------------------------
| Shipment Control (PengirimanController) Tests
|--------------------------------------------------------------------------
*/

test('admin can manage shipments via standard resource and quick-update endpoints', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $produk = ProdukAir::create([
        'nama_produk' => 'Rindu Galon 19L',
        'jenis_kemasan' => 'galon',
        'kapasitas' => '19L',
        'harga' => 20000,
        'stok' => 100,
        'status_produk' => 'tersedia',
    ]);

    $pelanggan = Pelanggan::create([
        'nama_pelanggan' => 'Charlie Deliver',
        'email' => 'charlie@gmail.com',
        'no_telepon' => '087788',
        'alamat' => 'Bandung',
        'penanggung_jawab' => 'Charlie',
        'jenis_pelanggan' => 'individu',
    ]);

    $transaksi = Transaksi::create([
        'id_pelanggan' => $pelanggan->id_pelanggan,
        'tanggal_transaksi' => now(),
        'metode_pembayaran' => 'transfer',
        'total_bayar' => 45000,
        'status_transaksi' => 'dibayar',
        'kode_invoice' => 'INV-DELIVERY-TEST',
        'metode_pengiriman' => 'standart',
        'biaya_pengiriman' => 5000,
    ]);

    $kurir = Kurir::create([
        'nama_kurir' => 'Kurir Cepat',
        'no_hp' => '089999999',
        'alamat' => 'Alamat Kurir',
        'status_kurir' => 'aktif',
        'kendaraan' => 'motor',
        'plat_nomor' => 'AD 1234 AB',
    ]);

    $pengiriman = Pengiriman::create([
        'id_transaksi' => $transaksi->id_transaksi,
        'id_kurir' => null,
        'alamat_tujuan' => 'Bandung',
        'tanggal_pengiriman' => now()->addDay(),
        'status_pengiriman' => 'dijadwalkan',
    ]);

    // Admin index view
    $response = $this->actingAs($admin)->get('/admin/pengiriman');
    $response->assertStatus(200);
    $response->assertSee('Charlie Deliver');

    // Admin quick-update PATCH: assign courier
    $response = $this->actingAs($admin)->patchJson("/admin/pengiriman/{$pengiriman->id_pengiriman}/quick-update", [
        'id_kurir' => $kurir->id_kurir,
        'status_pengiriman' => 'dijadwalkan',
    ]);
    $response->assertStatus(200);
    $response->assertJson(['success' => true]);

    $this->assertDatabaseHas('pengiriman', [
        'id_pengiriman' => $pengiriman->id_pengiriman,
        'id_kurir' => $kurir->id_kurir,
    ]);

    // Admin quick-update PATCH: change status to dalam perjalanan
    $response = $this->actingAs($admin)->patchJson("/admin/pengiriman/{$pengiriman->id_pengiriman}/quick-update", [
        'status_pengiriman' => 'dalam perjalanan',
    ]);
    $response->assertStatus(200);
    $response->assertJson(['success' => true]);

    $this->assertDatabaseHas('pengiriman', [
        'id_pengiriman' => $pengiriman->id_pengiriman,
        'status_pengiriman' => 'dalam perjalanan',
    ]);
});
