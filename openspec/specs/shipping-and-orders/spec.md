# shipping-and-orders Specification

## Purpose
TBD - created by archiving change update-orders-and-shipping. Update Purpose after archive.
## Requirements
### Requirement: Input Quantity Validation
The system SHALL validate the product quantity inputs in both the manual order (Pesan Instan) modal and the subscription form. If the user inputs a quantity less than or equal to 0, the form SHALL display a warning message and prevent form submission.

#### Scenario: Manual checkout with invalid quantity
- **WHEN** the user inputs a quantity of 0 or less in the manual checkout modal
- **THEN** a warning message "Jumlah unit harus minimal 1" is displayed and submission is blocked

#### Scenario: Subscription order with invalid quantity
- **WHEN** the user inputs a quantity of 0 or less in the subscription form
- **THEN** a warning message "Jumlah unit harus minimal 1" is displayed and submission is blocked

### Requirement: Shipping Method Selection and Pricing
The manual checkout modal SHALL provide a selection of three shipping methods:
1. Standard: 1-2 days delivery (Cost: Rp 5.000)
2. Sameday: Same day delivery if ordered before 08:00 WIB (Cost: Rp 15.000)
3. Instant: 3-4 hours delivery within the same city (Cost: Rp 25.000)
The total order price SHALL dynamically update in real-time as: (product_price * quantity) + shipping_cost.

#### Scenario: Selecting standard shipping method
- **WHEN** the user selects the Standard shipping method in the checkout modal
- **THEN** the shipping cost of Rp 5.000 is added to the total order price calculation

#### Scenario: Selecting sameday shipping method
- **WHEN** the user selects the Sameday shipping method in the checkout modal
- **THEN** the shipping cost of Rp 15.000 is added to the total order price calculation

#### Scenario: Selecting instant shipping method
- **WHEN** the user selects the Instant shipping method in the checkout modal
- **THEN** the shipping cost of Rp 25.000 is added to the total order price calculation

### Requirement: Subscription Delivery Calculation and Dates Generation
The system SHALL calculate the total deliveries for a subscription based on exactly 4 weeks (4 deliveries) per selected day per month. When a subscription is stored, the backend SHALL generate exactly `4 * durasi_bulan` delivery occurrences starting from the current date or the next upcoming day of the week selected.

#### Scenario: Subscription delivery count calculation
- **WHEN** the user selects 1 delivery day per week for 1 month
- **THEN** the estimated number of deliveries shown is exactly 4

#### Scenario: Subscription delivery generation
- **WHEN** a 1-month subscription is registered for Saturdays
- **THEN** the backend schedules exactly the next 4 Saturdays as delivery dates

### Requirement: Consistent Input and Dropdown Styling
The system inputs and dropdowns SHALL use a flat neobrutalist styling with thick solid borders and flat shadows, matching the rest of the application layout, replacing the old neomorphism soft shadows.

#### Scenario: Input rendering style
- **WHEN** form fields are rendered on the dashboard or admin pages
- **THEN** they display with a 3px solid black border and flat 3px black shadow

### Requirement: Grouped Subscription Transaction History
The transaction history for subscriptions SHALL be consolidated by subscription rather than listing each individual delivery transaction separately. The UI SHALL display each active/inactive subscription package as a single parent record, showing the total duration, chosen delivery days, and the overall total bill (calculated as quantity * unit_price * total_deliveries).

#### Scenario: Displaying subscription package in transaction list
- **WHEN** the user views the "Riwayat Berlangganan" tab
- **THEN** they see one consolidated row for each subscription package containing its schedule details and overall total cost

### Requirement: Grouped Subscription Shipment Tracking and Detail Modals
The shipment tracking for subscriptions SHALL display each subscription package as a single consolidated tracking card on the dashboard. Each subscription card SHALL provide a "Detail Pengiriman" action that opens a modal showing the chronological list of all individual deliveries with their respective dates, courier info, and current delivery status.

#### Scenario: Displaying subscription in shipment list
- **WHEN** the user views the "Jadwal Berlangganan" tab in Lacak Pengiriman
- **THEN** they see one card per subscription package with a "Detail Pengiriman" button

#### Scenario: Viewing individual deliveries status
- **WHEN** the user clicks the "Detail Pengiriman" button on a subscription tracking card
- **THEN** a neobrutalist modal displays the chronological list of all associated deliveries and their individual statuses

### Requirement: Admin Subscription Management
The system SHALL provide interfaces in the admin panel to view, create, edit, and delete subscription records. The creation and editing forms SHALL replace raw ID fields for customer and product selection with neobrutalist dropdown selects displaying descriptive names.

#### Scenario: Admin views subscriptions index
- **WHEN** the admin accesses the subscription management index
- **THEN** they see the list of active subscriptions with edit, detail, and delete action links

#### Scenario: Admin creates a manual subscription
- **WHEN** the admin opens the subscription creation form
- **THEN** they can select the customer and product using neobrutalist styled select dropdowns instead of raw text inputs

### Requirement: Order Creation and Processing
Orders MUST be created securely and correctly process stock availability.

#### Scenario: Concurrent Order Processing
- **WHEN** multiple users create an order simultaneously for the same product
- **THEN** the system uses pessimistic locking to guarantee stock is not oversold

#### Scenario: Order Cancellation Stock Restoration
- **WHEN** an admin cancels an existing transaction
- **THEN** the exact quantity of products from that transaction is restored to the product stock

