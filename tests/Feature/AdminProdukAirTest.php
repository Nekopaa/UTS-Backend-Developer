<?php

use App\Models\User;
use App\Models\ProdukAir;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

test('guest cannot access admin product resources', function () {
    $response = $this->get('/admin/produk-air');
    $response->assertRedirect('/login');

    $response = $this->get('/admin/produk-air/create');
    $response->assertRedirect('/login');

    $response = $this->post('/admin/produk-air', []);
    $response->assertRedirect('/login');
});

test('regular user cannot access admin product resources', function () {
    $user = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($user)->get('/admin/produk-air');
    $response->assertStatus(403);

    $response = $this->actingAs($user)->get('/admin/produk-air/create');
    $response->assertStatus(403);

    $response = $this->actingAs($user)->post('/admin/produk-air', []);
    $response->assertStatus(403);
});

test('admin can access product index and create page', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get('/admin/produk-air');
    $response->assertStatus(200);

    $response = $this->actingAs($admin)->get('/admin/produk-air/create');
    $response->assertStatus(200);
});

test('admin can create a product with custom capacity and status', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post('/admin/produk-air', [
        'nama_produk' => 'Rindu Galon Jumbo',
        'jenis_kemasan' => 'galon',
        'kapasitas' => '19L',
        'harga' => 25000,
        'stok' => 150,
        'status_produk' => 'habis',
        'deskripsi' => 'Galon air mineral ukuran 19 Liter.',
    ]);

    $response->assertRedirect('/admin/produk-air');
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('produk_air', [
        'nama_produk' => 'Rindu Galon Jumbo',
        'kapasitas' => '19L',
        'status_produk' => 'habis',
        'stok' => 150,
    ]);
});

test('admin can update a product capacity and status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $produk = ProdukAir::create([
        'nama_produk' => 'Rindu Gelas Kecil',
        'jenis_kemasan' => 'gelas',
        'kapasitas' => '220ml',
        'harga' => 1000,
        'stok' => 500,
        'status_produk' => 'tersedia',
    ]);

    $response = $this->actingAs($admin)->put("/admin/produk-air/{$produk->id_produk}", [
        'nama_produk' => 'Rindu Gelas Sedang',
        'jenis_kemasan' => 'gelas',
        'kapasitas' => '330ml', // Custom capacity not in original enum
        'harga' => 1200,
        'stok' => 450,
        'status_produk' => 'habis',
    ]);

    $response->assertRedirect('/admin/produk-air');
    $response->assertSessionHas('success');

    $produk->refresh();
    $this->assertEquals('Rindu Gelas Sedang', $produk->nama_produk);
    $this->assertEquals('330ml', $produk->kapasitas);
    $this->assertEquals('habis', $produk->status_produk);
});

test('admin can upload product photo in permitted formats up to 5MB', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    Storage::fake('public');

    $formats = ['jpeg', 'png', 'jpg', 'webp', 'gif'];
    
    foreach ($formats as $format) {
        $file = UploadedFile::fake()->image("product.{$format}")->size(4096); // 4MB

        $response = $this->actingAs($admin)->post('/admin/produk-air', [
            'nama_produk' => "Rindu Water {$format}",
            'jenis_kemasan' => 'galon',
            'kapasitas' => '19L',
            'harga' => 20000,
            'stok' => 100,
            'status_produk' => 'tersedia',
            'foto_produk' => $file,
            'deskripsi' => 'Testing photo upload.',
        ]);

        $response->assertRedirect('/admin/produk-air');
        
        $product = ProdukAir::where('nama_produk', "Rindu Water {$format}")->first();
        $this->assertNotNull($product->foto_produk);
        
        Storage::disk('public')->assertExists($product->foto_produk);
    }
});

test('admin cannot upload product photo with invalid format or exceeding 10MB', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    
    Storage::fake('public');

    // Test exceeding 10MB
    $largeFile = UploadedFile::fake()->image('large_product.jpg')->size(12000); // 12MB
    $response = $this->actingAs($admin)->post('/admin/produk-air', [
        'nama_produk' => 'Rindu Water Huge',
        'jenis_kemasan' => 'galon',
        'kapasitas' => '19L',
        'harga' => 20000,
        'stok' => 100,
        'status_produk' => 'tersedia',
        'foto_produk' => $largeFile,
        'deskripsi' => 'Testing too large photo.',
    ]);
    $response->assertSessionHasErrors('foto_produk');

    // Test invalid format
    $invalidFormatFile = UploadedFile::fake()->create('invalid.bmp', 1024, 'image/bmp');
    $response = $this->actingAs($admin)->post('/admin/produk-air', [
        'nama_produk' => 'Rindu Water BMP',
        'jenis_kemasan' => 'galon',
        'kapasitas' => '19L',
        'harga' => 20000,
        'stok' => 100,
        'status_produk' => 'tersedia',
        'foto_produk' => $invalidFormatFile,
        'deskripsi' => 'Testing invalid format.',
    ]);
    $response->assertSessionHasErrors('foto_produk');
});
