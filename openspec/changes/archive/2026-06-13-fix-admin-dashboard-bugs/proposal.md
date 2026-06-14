# Change: Fix Admin Dashboard QA Audit Bugs

## Why
A QA and security pentest revealed 6 critical logic and security flaws in the admin dashboard: missing stock restoration on transaction cancellation, subscription logic bypassing stock checks, race conditions during order creation, broken admin authentication via the dashboard, 500 server errors on related model deletion (missing cascades), and dead code for stock history/sales reports.

## What Changes
- Add Soft Deletes to `ProdukAir`, `Kurir`, and `Pelanggan` to prevent 500 errors on foreign key constraints.
- Implement `ProdukAirObserver` and `TransaksiObserver` to automatically populate `riwayat_stock` and `laporan_penjualan` tables.
- Update `LanggananController` and `OrderController` to validate stock at the time of order creation and delivery.
- Add pessimistic locking (`lockForUpdate()`) inside `OrderController` to prevent race conditions leading to negative stock.
- Update `TransaksiController` to restore stock when a transaction is cancelled.
- Fix `AdminController` to create an associated `User` model when a new Admin is added.

## Impact
- Affected specs: `shipping-and-orders`, `subscriptions` (new), `inventory-management` (new), `admin-management` (new)
- Affected code: `ProdukAir`, `Kurir`, `Pelanggan` Models, `LanggananController`, `OrderController`, `TransaksiController`, `AdminController`, and new Observers.
