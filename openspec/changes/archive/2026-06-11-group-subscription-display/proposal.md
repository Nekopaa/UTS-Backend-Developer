# Change: Group Subscription Display

## Why
Displaying every individual delivery date/payment of a subscription as a separate row or card on the user's dashboard causes unnecessary clutter and makes it hard to track active subscriptions. Grouping deliveries by subscription package provides a clean, user-friendly view of their subscription contracts and detailed statuses.

## What Changes
- **Feature**: Group subscription transactions under "Riwayat Transaksi" to show each subscription package as a single consolidated row with its schedule, duration, and total billing.
- **Feature**: Group subscription shipments under "Lacak Pengiriman" to show each active subscription as a single card, with a "Detail Pengiriman" button.
- **Feature**: Add an interactive detail modal for each subscription card to trace the status of its individual delivery dates.
- **Code**: Define `transaksi` relation in `Langganan` model and `pengiriman` relation in `Transaksi` model.
- **Code**: Update `routes/web.php` to eager-load relations when fetching dashboard data.

## Impact
- Affected specs: `shipping-and-orders`
- Affected files:
  - `app/Models/langganan.php` (Define `transaksi` relationship)
  - `app/Models/transaksi.php` (Define `pengiriman` relationship)
  - `routes/web.php` (Eager load relations in dashboard route)
  - `resources/views/dashboard.blade.php` (Add sub-tab toggle JS handlers, consolidate lists, add detail modals)
