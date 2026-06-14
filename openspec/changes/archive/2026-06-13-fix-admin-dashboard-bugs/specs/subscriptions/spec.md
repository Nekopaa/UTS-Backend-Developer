## ADDED Requirements
### Requirement: Subscription Orders Stock Processing
The system MUST handle product stock deduction accurately for subscription-based recurring deliveries.

#### Scenario: Subscription Delivery Processing
- **WHEN** a subscription shipment is prepared for delivery
- **THEN** the product stock MUST be verified and deducted dynamically
- **WHEN** the product is out of stock during a subscription run
- **THEN** the shipment fails gracefully or notifies the user
