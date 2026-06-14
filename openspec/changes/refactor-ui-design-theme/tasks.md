## 1. Style & Token Definition
- [ ] 1.1 Update `resources/views/layouts/admin.blade.php` style definitions to override neobrutalist class styles with Soft Glassmorphic & SaaS Modern styles.
- [ ] 1.2 Update `resources/views/layouts/app.blade.php` style definitions to override neobrutalist class styles with Soft Glassmorphic & SaaS Modern styles.

## 2. Admin Layouts & Views Class Overhauls
- [ ] 2.1 Refactor `admin/dashboard.blade.php` layout and cards to remove flat black shadow and border utilities (replacing with soft shadow/border styling).
- [ ] 2.2 Refactor `produk_air` views (`index`, `create`, `edit`, `show`) inline class tags.
- [ ] 2.3 Refactor `gudang` views (`index`, `create`, `edit`, `show`) inline class tags.
- [ ] 2.4 Refactor `riwayat_stock` views (`index`, `show`) inline class tags.
- [ ] 2.5 Refactor `transaksi` views (`index`, `show`) inline class tags.
- [ ] 2.6 Refactor `langganan` views (`index`, `create`, `edit`, `show`) inline class tags.
- [ ] 2.7 Refactor `kurir` views (`index`, `create`, `edit`, `show`) inline class tags.
- [ ] 2.8 Refactor `pengiriman` views (`index`, `show`) inline class tags.
- [ ] 2.9 Refactor `pelanggan` views (`index`, `create`, `edit`, `show`) inline class tags.
- [ ] 2.10 Refactor `user` views (`index`) inline class tags.

## 3. Customer Portal & General Views Overhauls
- [ ] 3.1 Refactor `pelanggan/pelanggan_dashboard.blade.php` to use Soft Glassmorphic SaaS style.
- [ ] 3.2 Refactor `pelanggan/pengiriman_index.blade.php` to use Soft Glassmorphic SaaS style.
- [ ] 3.3 Refactor `pelanggan/create_langganan.blade.php` to use Soft Glassmorphic SaaS style.
- [ ] 3.4 Refactor `transaksi/customer_index.blade.php` to use Soft Glassmorphic SaaS style.
- [ ] 3.5 Refactor `transaksi/customer_show.blade.php` to use Soft Glassmorphic SaaS style.
- [ ] 3.6 Refactor `dashboard.blade.php` to use Soft Glassmorphic SaaS style.
- [ ] 3.7 Refactor landing/home views (`welcomeblade.blade.php`, `welcome.blade.php`) inline class tags.

## 4. Auth & Profile Views Overhauls
- [ ] 4.1 Refactor `auth/login.blade.php` and `auth/register.blade.php` to use Soft Glassmorphic SaaS style.
- [ ] 4.2 Refactor password reset and email verification views in `auth/`.
- [ ] 4.3 Refactor `profile/edit.blade.php` profile page layouts and forms.

## 5. Verification & Testing
- [ ] 5.1 Run automated test suite (`php artisan test`) to verify all interfaces load correctly and no 500 errors occur.
- [ ] 5.2 Run OpenSpec validation (`openspec validate refactor-ui-design-theme`).
