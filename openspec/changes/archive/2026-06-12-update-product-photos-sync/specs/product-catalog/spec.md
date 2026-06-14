## ADDED Requirements

### Requirement: Dynamic Product Photo Display
The system SHALL dynamically display the custom product photo from the database across the landing page, customer dashboards, and admin catalog views. If no custom photo has been uploaded, the views SHALL display a consistent default placeholder image representing the product's packaging type (`jenis_kemasan`):
1. `galon` -> `images/produk_galon.jpg`
2. `botol` -> `images/produk_botol.jpg`
3. `gelas` -> `images/produk_gelas.jpg`

#### Scenario: Displaying custom product photo on landing page
- **WHEN** the user visits the welcome page and a custom photo is set for a product
- **THEN** the welcome page displays the custom product photo from storage

#### Scenario: Displaying fallback product photo on landing page
- **WHEN** the user visits the welcome page and no custom photo is set for a "botol" product
- **THEN** the welcome page displays `images/produk_botol.jpg`

#### Scenario: Displaying fallback product photo on customer dashboard
- **WHEN** the customer views the dashboard and no custom photo is set for a "galon" product
- **THEN** the customer dashboard displays `images/produk_galon.jpg`

#### Scenario: Displaying fallback product photo on admin product index
- **WHEN** the admin views the product catalog index and no custom photo is set for a "gelas" product
- **THEN** the admin product catalog index displays `images/produk_gelas.jpg`
