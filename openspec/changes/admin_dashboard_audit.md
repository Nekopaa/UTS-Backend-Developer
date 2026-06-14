# Admin Dashboard QA & Security Audit Report

## Overview
This report covers the QA and security audit performed on the `rindu_water` Admin Dashboard. The focus was on identifying logic flaws, UI bugs, and security vulnerabilities related to transactions, products, stock management, subscriptions, and administrative user management.

---

## 1. Logic Flaws & Vulnerabilities

### A. Missing Stock Restoration on Cancelled Transactions
**Severity:** High
**Location:** `App\Http\Controllers\TransaksiController@update`
**Description:**
When an administrator updates the status of a transaction to `dibatalkan` (cancelled), the system successfully updates the status but **fails to restore the stock** of the associated product(s). The stock remains permanently deducted, leading to inaccurate inventory counts.
**Recommendation:** Hook into the transaction update logic (or use an Observer) to add the quantity back to `ProdukAir::stok` whenever a transaction is cancelled.

### B. Unlimited Free Purchases via Subscription Logic (No Stock Deduction)
**Severity:** Critical
**Location:** `App\Http\Controllers\LanggananController@store`
**Description:**
When a customer creates a new subscription ("Langganan Cerdas"), the controller creates multiple future `Transaksi`, `DetailPesanan`, and `Pengiriman` records automatically. However, **the system never checks if there is sufficient stock**, nor does it deduct stock (`$produk->decrement('stok', ...)`) for these scheduled orders. This allows users to subscribe and "purchase" products indefinitely, bypassing out-of-stock validations completely.
**Recommendation:** The system should either check and allocate stock upfront, or validate and deduct stock dynamically on the day the order is shipped.

### C. Race Condition (TOCTOU) in Order Creation
**Severity:** Medium
**Location:** `App\Http\Controllers\OrderController@store`
**Description:**
The order creation logic checks if there is enough stock (`if ($produk->stok < $request->jumlah)`) and then subsequently decrements it (`$produk->decrement('stok', ...)`). Because no database row-locking is used, concurrent requests for the exact same product could both pass the initial condition check before either request has a chance to decrement the stock, resulting in a negative inventory balance.
**Recommendation:** Fetch the product using pessimistic locking (`lockForUpdate()`) inside the DB transaction before checking and decrementing the stock.

### D. Broken Admin Authentication (Disconnected Admin Model)
**Severity:** High
**Location:** `App\Http\Controllers\AdminController@store`
**Description:**
Administrators can use the dashboard to create new Admins. This process inserts a new record into the `admin` table. However, the system's authentication relies on the `users` table and checks `role:admin`. Because creating an Admin via the dashboard does not create a corresponding `User` record, **the newly created administrator cannot log in to the system**. The `Admin` table is functionally isolated from standard Laravel Authentication.
**Recommendation:** Refactor admin creation to simultaneously create a `User` with `role = 'admin'` or switch authentication to authenticate against the `admin` table for admin guards.

### E. Severe SQL 500 Errors on Deletion (Missing Foreign Key Cascades)
**Severity:** Medium
**Location:** `App\Http\Controllers\ProdukAirController@destroy`, `KurirController@destroy`, etc. & `database/migrations`
**Description:**
Most dashboard controllers (e.g., `ProdukAirController`, `KurirController`) allow an administrator to delete a record directly (`$produk->delete()`). However, because the database migrations omit `onDelete('cascade')` or `onDelete('set null')`, attempting to delete a product that has been sold—or a courier that has a shipment history—will trigger a fatal `500 Internal Server Error` due to foreign key constraint violations.
**Recommendation:** Use Soft Deletes on Models like `ProdukAir`, `Pelanggan`, and `Kurir`. If hard deletes are required, ensure related transactions and histories handle the deletion gracefully (e.g., `onDelete('cascade')`).

### F. Ghost Features: "Riwayat Stock" & "Laporan Penjualan" 
**Severity:** Low (Usability/Feature Incompletion)
**Location:** `App\Http\Controllers\RiwayatStockController` and `LaporanPenjualanController`
**Description:**
The dashboard has views and controllers for displaying Stock History (`RiwayatStock`) and Sales Reports (`LaporanPenjualan`). However, an exhaustive code search reveals that **no records are ever inserted into these tables**. The models and tables exist, but the application logic never triggers `create()` or `save()` for them when stock changes or sales occur. 
**Recommendation:** Implement Event Listeners/Observers on `ProdukAir` (for stock changes) and `Transaksi` (for completed sales) to populate these tables.

---

## Conclusion
The dashboard performs basic CRUD well but relies on an incomplete implementation of business logic constraints. Addressing the stock race conditions, transaction cancellations, subscription stock deductions, and foreign-key deletion cascades is critical before production deployment to ensure data integrity and prevent logical exploits.
