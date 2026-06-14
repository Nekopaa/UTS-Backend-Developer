## ADDED Requirements

### Requirement: Unique Courier Phone Number and License Plate
The system SHALL validate that a courier's phone number (`no_hp`) and vehicle license plate (`plat_nomor`) are unique across all active couriers. If a duplicate phone number or license plate is submitted during courier creation or modification, the system SHALL reject the submission and display a validation error message.

#### Scenario: Creating a courier with duplicate phone number
- **WHEN** the admin attempts to create a courier with a phone number that is already assigned to an active courier
- **THEN** the submission is blocked and a validation error "Nomor HP sudah terdaftar untuk kurir lain." is displayed

#### Scenario: Creating a courier with duplicate license plate
- **WHEN** the admin attempts to create a courier with a license plate that is already assigned to an active courier
- **THEN** the submission is blocked and a validation error "Plat nomor kendaraan sudah terdaftar untuk kurir lain." is displayed

#### Scenario: Updating a courier with duplicate license plate
- **WHEN** the admin attempts to update a courier's license plate to a plate that is already assigned to another active courier
- **THEN** the submission is blocked and a validation error "Plat nomor kendaraan sudah terdaftar untuk kurir lain." is displayed
