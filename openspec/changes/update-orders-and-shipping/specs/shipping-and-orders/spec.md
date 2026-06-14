## ADDED Requirements

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
