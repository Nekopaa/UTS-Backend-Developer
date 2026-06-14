# Change: update-admin-subscription-management

## Why
The admin dashboard for subscription management lacks basic CRUD links/actions (detail, edit, delete) on the subscription listing page. Furthermore, the manual subscription creation and editing pages use raw numeric ID inputs for customer and product selections, which is error-prone and offers poor user experience.

## What Changes
- **MODIFIED**: `resources/views/langganan/index.blade.php` to include an "Aksi" column with links/forms for showing detail, editing, and deleting a subscription.
- **MODIFIED**: `app/Http/Controllers/LanggananController.php` to eager load and pass customers (`Pelanggan::all()`) and products (`ProdukAir::all()`) to the `create` and `edit` views.
- **MODIFIED**: `resources/views/langganan/create.blade.php` to replace raw text input numbers for `id_pelanggan` and `id_produk` with neobrutalist styled select dropdowns.
- **MODIFIED**: `resources/views/langganan/edit.blade.php` to replace raw text input numbers for `id_pelanggan` and `id_produk` with neobrutalist styled select dropdowns.

## Impact
- Affected specs: `specs/shipping-and-orders/spec.md`
- Affected code:
  - [LanggananController.php](file:///d:/project-semester-2/rindu_water/app/Http/Controllers/LanggananController.php)
  - [index.blade.php](file:///d:/project-semester-2/rindu_water/resources/views/langganan/index.blade.php)
  - [create.blade.php](file:///d:/project-semester-2/rindu_water/resources/views/langganan/create.blade.php)
  - [edit.blade.php](file:///d:/project-semester-2/rindu_water/resources/views/langganan/edit.blade.php)
