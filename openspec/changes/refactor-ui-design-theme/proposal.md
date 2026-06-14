# Change: Refactor UI Design Theme (Neobrutalism to Soft Glassmorphic SaaS)

## Why
The current Neobrutalism design system (harsh black borders, flat solid shadows, and high contrast saturated colors) is being evaluated for academic and professional presentation. The user requested moving away from Neobrutalism to a more modern, formal, and premium aesthetic. This visual theme overhaul must be applied consistently across the entire application, including BOTH the admin portal and the customer/user portal. While pure Neumorphism was proposed, we recommend a **Soft Glassmorphic SaaS** theme, which keeps the clean 3D soft shadows of neumorphism but combines it with frosted glass translucency and high-contrast typography to ensure excellent readability and accessibility.

## What Changes
- **Visual Theme Overhaul**: Replace Neobrutalism cards, buttons, badges, inputs, and scrollbars with a premium, sleek **Soft Glassmorphic & SaaS Modern UI** style.
- **Card Styles**: Remove thick black borders and flat black shadows. Replace them with borderless or thin low-opacity borders, frosted glass backgrounds (`backdrop-filter: blur`), and deep multi-layered soft ambient shadows.
- **Button Styles**: Replace neobrutalist buttons with soft-shaded gradient buttons featuring subtle hover transitions and micro-animations.
- **Input & Select Fields**: Refactor fields to use soft white/slate backgrounds with ambient drop shadows, light indigo/slate borders on focus, and smooth scaling.
- **Layout & Backgrounds**: Introduce a soft mesh gradient background (subtle light blue/indigo/purple hues) behind both portals rather than the flat cream/beige color.
- **Spec Updates**: Update `shipping-and-orders` styling requirements to align with the new theme.

## Impact
- Affected specs: `shipping-and-orders`
- Affected code:
  - Layouts: `layouts/admin.blade.php`, `layouts/app.blade.php`
  - Admin Portal Views: `admin/dashboard.blade.php`, and all resource views (`produk_air`, `gudang`, `kurir`, `pelanggan`, `transaksi`, `pengiriman`, `langganan`, `user`).
  - Customer Portal Views: `pelanggan/pelanggan_dashboard.blade.php`, `pelanggan/pengiriman_index.blade.php`, `pelanggan/create_langganan.blade.php`, `transaksi/customer_index.blade.php`, `transaksi/customer_show.blade.php`, `dashboard.blade.php`, `welcomeblade.blade.php`, `welcome.blade.php`.
  - Auth Portal Views: `auth/login.blade.php`, `auth/register.blade.php`, and other views in `auth/` and `profile/`.
