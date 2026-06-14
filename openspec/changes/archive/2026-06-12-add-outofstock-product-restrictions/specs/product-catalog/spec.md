## ADDED Requirements

### Requirement: Out-of-Stock Product Visual Styling and Action Disabling
The system SHALL visually style product catalog items with 0 stock as grayed out (using reduced opacity, grayscale, and disabled borders/shadows) in the authenticated user, customer, and admin dashboards. Any immediate action buttons (e.g. "Pesan Instan") for out-of-stock products SHALL be disabled and display "Habis" instead of the normal action text. The public landing page (`welcomeblade.blade.php`) SHALL NOT apply this visual styling and remain fully colored and normal.

#### Scenario: Visual styling of out-of-stock product on customer dashboard
- **WHEN** a customer views the dashboard and a product has 0 stock
- **THEN** the product card displays with a grayed-out/grayscale style

#### Scenario: Disabled action button on customer dashboard
- **WHEN** a customer views a product with 0 stock in the instant order catalog
- **THEN** the "Pesan Instan" button is disabled and replaced by a "Habis" label

#### Scenario: Visual styling of out-of-stock product on admin index
- **WHEN** the admin views the product catalog index and a product has 0 stock
- **THEN** the product card displays with a grayed-out/grayscale style

### Requirement: Out-of-Stock Subscription Restrictions
The system SHALL prevent customers from selecting or creating subscriptions for out-of-stock products. In the subscription creation form, the product selection dropdown options for out-of-stock items SHALL show a "(Stok: Habis)" label and be disabled (unselectable). Additionally, the backend validator SHALL reject any incoming subscription request if the requested unit quantity exceeds the product's available stock level.

#### Scenario: Disabled out-of-stock product option in subscription form
- **WHEN** a customer opens the subscription form and attempts to select a product with 0 stock
- **THEN** the option is grayed out, shows "(Stok: Habis)", and cannot be clicked or selected

#### Scenario: Backend rejects subscription for out-of-stock product
- **WHEN** a customer submits a subscription request for a product with 0 stock or with a quantity exceeding the available stock
- **THEN** the transaction is rolled back, the request is rejected, and the customer is redirected back with an error message "Stok produk tidak mencukupi untuk jumlah pesanan Anda."
