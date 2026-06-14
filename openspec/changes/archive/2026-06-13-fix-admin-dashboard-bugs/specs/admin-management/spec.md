## ADDED Requirements
### Requirement: Administrative User Provisioning
The system MUST correctly provision administrative user accounts.

#### Scenario: Admin Dashboard Provisioning
- **WHEN** an admin creates a new admin user via the dashboard
- **THEN** the system MUST create a corresponding `User` record with the `role` set to 'admin' to ensure functional authentication
