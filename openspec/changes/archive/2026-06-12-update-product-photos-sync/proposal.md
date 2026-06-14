# Change: Synchronize Product Photos Across Dashboards and Landing Page

## Why
Currently, the landing page, user dashboard, and admin dashboard handle product images inconsistently. Some dashboards display emojis (e.g., in user dashboard and admin list) or omit placeholders entirely (e.g., in customer details) when a custom product photo is not uploaded, rather than using consistent default placeholder images. Additionally, product photos must sync dynamically across the landing page, user dashboard, and admin dashboard when changed in the admin panel.

## What Changes
- Standardize all views showing product cards to load from the same `ProdukAir` database model.
- If a custom `foto_produk` is uploaded, it must display dynamically on:
  - Landing Page (`welcomeblade.blade.php`)
  - User Dashboard (`dashboard.blade.php`)
  - Customer/Pelanggan Dashboard (`pelanggan/pelanggan_dashboard.blade.php`)
  - Admin Catalog Index (`produk_air/index.blade.php`)
  - Admin Catalog Detail (`produk_air/show.blade.php`)
- If a custom `foto_produk` is null or empty, it must fall back to the consistent default placeholder images based on the packaging type (`jenis_kemasan`):
  - `galon` -> `images/produk_galon.jpg`
  - `botol` -> `images/produk_botol.jpg`
  - `gelas` -> `images/produk_gelas.jpg`

## Impact
- Affected specs: `product-catalog` (new spec)
- Affected code:
  - `resources/views/welcomeblade.blade.php`
  - `resources/views/dashboard.blade.php`
  - `resources/views/pelanggan/pelanggan_dashboard.blade.php`
  - `resources/views/produk_air/index.blade.php`
  - `resources/views/produk_air/show.blade.php`
