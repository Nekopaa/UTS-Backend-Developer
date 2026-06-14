# Change: Update Orders and Shipping

## Why
Users need more flexible shipping options with accurate pricing, proper input validation (preventing negative values), correct subscription calculations (4 deliveries per month), and a consistent neobrutalist design system across all views (removing neomorphism style input fields and dropdowns).

## What Changes
- **Feature**: Add shipping method selection (Standard, Sameday, Instant) in checkout modal with different costs.
- **Feature**: Dynamically update total price based on quantity and selected shipping method.
- **Bug Fix**: Validate quantity inputs (direct order and subscription) to show a warning when <= 0.
- **Bug Fix**: Fix the subscription delivery calculation to default to exactly 4 deliveries per week-day per month.
- **Bug Fix**: Fix Carbon rawAddUnit Type Error in `LanggananController`.
- **Aesthetics**: Redesign `.neo-brutal-input` and custom dropdowns to use flat neobrutalist borders and shadows instead of neomorphism.
- **Database**: Add `metode_pengiriman` and `biaya_pengiriman` to `transaksi` table.

## Impact
- Affected specs: `shipping-and-orders`
- Affected files:
  - `resources/views/layouts/app.blade.php` (CSS stylesheet & select transformer)
  - `resources/views/layouts/admin.blade.php` (CSS stylesheet)
  - `resources/views/dashboard.blade.php` (Quantity warnings, JS calculation, Shipping method select)
  - `app/Http/Controllers/OrderController.php` (Save shipping method and cost, validate qty)
  - `app/Http/Controllers/LanggananController.php` (Fix Carbon type issue, generate exact 4 deliveries per month)
