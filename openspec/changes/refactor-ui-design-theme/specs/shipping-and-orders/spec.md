## MODIFIED Requirements

### Requirement: Consistent Input and Dropdown Styling
The system inputs and dropdowns SHALL use a premium, soft glassmorphic & SaaS modern styling with thin low-opacity borders and soft ambient drop shadows, matching the rest of the application layout.

#### Scenario: Input rendering style
- **WHEN** form fields are rendered on the dashboard or admin pages
- **THEN** they display with a 1px solid slate border and a soft ambient drop shadow

### Requirement: Grouped Subscription Shipment Tracking and Detail Modals
The shipment tracking for subscriptions SHALL display each subscription package as a single consolidated tracking card on the dashboard. Each subscription card SHALL provide a "Detail Pengiriman" action that opens a modal showing the chronological list of all individual deliveries with their respective dates, courier info, and current delivery status.

#### Scenario: Displaying subscription in shipment list
- **WHEN** the user views the "Jadwal Berlangganan" tab in Lacak Pengiriman
- **THEN** they see one card per subscription package with a "Detail Pengiriman" button

#### Scenario: Viewing individual deliveries status
- **WHEN** the user clicks the "Detail Pengiriman" button on a subscription tracking card
- **THEN** a premium modal displays the chronological list of all associated deliveries and their individual statuses

### Requirement: Admin Subscription Management
The system SHALL provide interfaces in the admin panel to view, create, edit, and delete subscription records. The creation and editing forms SHALL replace raw ID fields for customer and product selection with premium dropdown selects displaying descriptive names.

#### Scenario: Admin views subscriptions index
- **WHEN** the admin accesses the subscription management index
- **THEN** they see the list of active subscriptions with edit, detail, and delete action links

#### Scenario: Admin creates a manual subscription
- **WHEN** the admin opens the subscription creation form
- **THEN** they can select the customer and product using premium styled select dropdowns instead of raw text inputs
