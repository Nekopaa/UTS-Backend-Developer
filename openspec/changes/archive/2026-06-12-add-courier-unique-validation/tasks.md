## 1. Implementation
- [x] 1.1 Update `no_hp` and `plat_nomor` validation rules in `KurirController@store` to enforce unique constraints (ignoring soft-deleted rows).
- [x] 1.2 Update `no_hp` and `plat_nomor` validation rules in `KurirController@update` to enforce unique constraints (ignoring soft-deleted rows and current record).
- [x] 1.3 Add custom error messages for the unique rules in both controller methods.
- [x] 1.4 Run QA tests to ensure courier management functions correctly and displays validation errors when entering duplicate data.
