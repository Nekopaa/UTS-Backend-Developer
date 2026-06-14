## 1. Backend & Models
- [x] 1.1 Add `transaksi` relationship to `App\Models\Langganan`
- [x] 1.2 Add `pengiriman` relationship to `App\Models\Transaksi`
- [x] 1.3 Update `routes/web.php` dashboard route to eager load relations (`produk`, `transaksi.pengiriman.kurir`, `transaksi.detailPesanan`) for `$mySubscriptions` and `$myTransactions`

## 2. Frontend JS Handlers
- [x] 2.1 Add `switchDeliveryType` and `switchTxType` JavaScript functions at the bottom script section of `dashboard.blade.php`

## 3. UI Grouping Implementation
- [x] 3.1 Consolidate "Riwayat Berlangganan" table in `dashboard.blade.php` to display subscription packages instead of individual transactions
- [x] 3.2 Consolidate "Jadwal Berlangganan" cards in `dashboard.blade.php` to display active subscriptions instead of individual delivery cards
- [x] 3.3 Add neobrutalist detail modals for each subscription to trace individual delivery schedules, dates, and statuses chronologically
- [x] 3.4 Fix HTML nesting bug at the end of transactions tab in dashboard.blade.php to restore the right sidebar layout

## 4. Verification
- [x] 4.1 Run `openspec validate` to ensure specs are correct
- [x] 4.2 Verify tab switching and sub-tab switching on dashboard
- [x] 4.3 Verify subscription purchase displays correctly as a single grouped transaction and shipment tracking card
- [x] 4.4 Verify details modal lists all deliveries for a subscription with accurate statuses
