## ADDED Requirements

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
