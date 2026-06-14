# Change: Restrict Out-of-Stock Product Purchases and Update Dashboard UI/UX

## Why
Currently, customers can order or subscribe to products that are out of stock because there is no frontend/backend restriction on subscription creation. To prevent bad user experience, we will show stock levels and disable out-of-stock options inside the subscription form, and style out-of-stock product cards as grayed-out in the authenticated dashboards (user and admin dashboards). However, the public landing page (`welcomeblade.blade.php`) must remain completely unchanged (normal/fully colored) to showcase available catalog items.

## What Changes
- Public Landing Page (`welcomeblade.blade.php`) remains completely unchanged (do NOT apply grayed-out styling or change badges).
- Authenticated User Dashboard (`dashboard.blade.php`) and Customer Dashboard (`pelanggan_dashboard.blade.php`) style out-of-stock product cards as grayed-out (using reduced opacity, grayscale, and disabled "Habis" buttons).
- Admin Product Index (`produk_air/index.blade.php`) styles out-of-stock product cards as grayed-out.
- Update the subscription product select dropdown in `dashboard.blade.php` to display stock levels (e.g. `(Stok: X)` or `(Stok: Habis)`) and disable options for out-of-stock products.
- Enforce backend validation in `LanggananController@store` to block subscription creation if the product stock is insufficient or out of stock.

## Impact
- Affected specs: `product-catalog`
- Affected code:
  - `resources/views/dashboard.blade.php`
  - `resources/views/pelanggan/pelanggan_dashboard.blade.php`
  - `resources/views/produk_air/index.blade.php`
  - `app/Http/Controllers/LanggananController.php`
