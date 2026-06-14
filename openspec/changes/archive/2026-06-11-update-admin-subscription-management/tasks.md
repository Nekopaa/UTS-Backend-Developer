## 1. Backend Controller Updates
- [x] 1.1 Load `Pelanggan::all()` and `ProdukAir::all()` in `LanggananController@create` and `LanggananController@edit`. Pass them to views.

## 2. Admin View Updates
- [x] 2.1 Update `resources/views/langganan/index.blade.php` to add action buttons column (Detail, Edit, Hapus) and forms.
- [x] 2.2 Update `resources/views/langganan/create.blade.php` to replace raw number inputs for `id_pelanggan` and `id_produk` with select dropdowns.
- [x] 2.3 Update `resources/views/langganan/edit.blade.php` to replace raw number inputs for `id_pelanggan` and `id_produk` with select dropdowns.

## 3. Verification
- [x] 3.1 Validate syntax on all modified controllers and views.
- [x] 3.2 Verify select dropdowns load names and persist correctly.
- [x] 3.3 Verify delete and detail actions.
