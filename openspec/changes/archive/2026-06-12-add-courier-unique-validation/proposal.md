# Change: Unique Phone Number and License Plate Validation for Couriers

## Why
Currently, the admin can register multiple couriers sharing the same phone number and/or vehicle license plate, leading to data inconsistency and ambiguity in shipping assignments.

## What Changes
- Add validation constraints in `KurirController` to ensure that phone numbers (`no_hp`) and license plates (`plat_nomor`) are unique across all active (non-soft-deleted) couriers.
- Display clear validation error messages when duplication is detected.
- Implement both `store` (create) and `update` (edit) unique validation rules.

## Impact
- Affected specs: `courier-management` (new spec)
- Affected code:
  - `app/Http/Controllers/KurirController.php`
