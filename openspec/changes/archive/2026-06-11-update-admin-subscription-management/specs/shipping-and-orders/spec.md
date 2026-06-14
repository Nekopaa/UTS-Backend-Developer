## ADDED Requirements

### Requirement: Admin Subscription Management
The system SHALL provide interfaces in the admin panel to view, create, edit, and delete subscription records. The creation and editing forms SHALL replace raw ID fields for customer and product selection with neobrutalist dropdown selects displaying descriptive names.

#### Scenario: Admin views subscriptions index
- **WHEN** the admin accesses the subscription management index
- **THEN** they see the list of active subscriptions with edit, detail, and delete action links

#### Scenario: Admin creates a manual subscription
- **WHEN** the admin opens the subscription creation form
- **THEN** they can select the customer and product using neobrutalist styled select dropdowns instead of raw text inputs
