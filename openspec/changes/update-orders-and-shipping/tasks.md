## 1. Database
- [x] 1.1 Create migration to add `metode_pengiriman` and `biaya_pengiriman` to `transaksi` table
- [x] 1.2 Run migration
- [x] 1.3 Add `metode_pengiriman` and `biaya_pengiriman` to `Transaksi` model `$fillable` array

## 2. Layout & Styles
- [x] 2.1 Update `layouts/app.blade.php` to define true neobrutalist styling for `.neo-brutal-input` and `.custom-dropdown-*`
- [x] 2.2 Add custom select dropdown transformer script to `layouts/app.blade.php`
- [x] 2.3 Update `layouts/admin.blade.php` to define true neobrutalist styling for `.neo-brutal-input` and `.custom-dropdown-*`

## 3. Frontend / Views
- [x] 3.1 In `dashboard.blade.php`, implement quantity validation warning for Pesan Instan modal (under 0 / <= 0)
- [x] 3.2 In `dashboard.blade.php`, implement quantity validation warning for Berlangganan form (under 0 / <= 0)
- [x] 3.3 Add Shipping Method selection dropdown to Pesan Instan checkout modal in `dashboard.blade.php`
- [x] 3.4 Update `calculateModalTotal` and modal state in `dashboard.blade.php` to calculate price dynamically with shipping cost
- [x] 3.5 Fix `calculateSubTotal` in `dashboard.blade.php` to calculate exactly 4 deliveries per selected day per month

## 4. Backend Controllers
- [x] 4.1 Update `OrderController.php` to validate quantity (>= 1) and shipping method/cost, and save them in the transaction database
- [x] 4.2 Update `LanggananController.php` to cast `$request->durasi_bulan` to integer, validating quantity (>= 1)
- [x] 4.3 In `LanggananController.php`, update the delivery dates generator to generate exactly `4 * durasi_bulan` occurrences per chosen day

## 5. Verification
- [x] 5.1 Run `openspec validate` to ensure specs are correct
- [x] 5.2 Test manual checkout with various shipping methods
- [x] 5.3 Test subscription activation and verify invoice generation
