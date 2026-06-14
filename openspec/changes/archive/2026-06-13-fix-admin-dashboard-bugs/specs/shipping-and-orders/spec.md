## ADDED Requirements
### Requirement: Order Creation and Processing
Orders MUST be created securely and correctly process stock availability.

#### Scenario: Concurrent Order Processing
- **WHEN** multiple users create an order simultaneously for the same product
- **THEN** the system uses pessimistic locking to guarantee stock is not oversold

#### Scenario: Order Cancellation Stock Restoration
- **WHEN** an admin cancels an existing transaction
- **THEN** the exact quantity of products from that transaction is restored to the product stock
