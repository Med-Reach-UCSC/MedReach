# Schema changes from the ER diagram

The starting point is `docs/UML Diagrams/MedReach_ER.drawio`. This file lists
every place where `database/medreach.sql` differs from it, and why. When you
change the schema, add a line here in the same commit.

## Current structure

| Table | Columns | Status |
|---|---|---|
| `USER` | user_id, first_name, last_name, email, password_hash, phone, role, status, is_verified, created_at | Built |
| `PATIENT` | patient_id, user_id, date_of_birth, address, is_guardian, managed_by_patient_id | Built |
| `PHARMACY` | pharmacy_id, name, licence_no, address, city, operating_hours, avg_rating, status, created_at | Built |
| `PHARMACIST` | pharmacist_id, user_id, pharmacy_id | Built |
| `DELIVERY_PERSON` | delivery_person_id, user_id, nic_no, vehicle_type, vehicle_number, is_available | Built |
| `OTP_CODE` | user_id, purpose, code_hash, attempts, expires_at, created_at | Built (new) |
| `SUPPORT_TICKET` | ticket_id, user_id, topic, message, status, admin_reply, created_at, resolved_at | Built (new) |
| `PRESCRIPTION`, `BROADCAST`, `ORDERS`, `ORDER_ITEM`, `SUBSTITUTION`, `DELIVERY`, `RATING`, `NOTIFICATION`, `MEDICINE_SCHEDULE` | As in the ER diagram | Not built yet — each module owner adds theirs |

## Changes to existing entities

| Entity | ER diagram | Now | Why |
|---|---|---|---|
| `USER` | `full_name` | `first_name`, `last_name` | Sign-up and greetings need them separately |
| `USER` | `is_active` | `status` ENUM(`pending`, `active`, `deactivated`) | Pharmacists and delivery people wait for admin approval, which a boolean can't show |
| `USER` | — | `is_verified` | Email must be confirmed with a one-time code before sign-in |
| `PATIENT` | "manages" relationship | `managed_by_patient_id` (self FK) | How a guardian links to the patients they manage |
| `PATIENT` | — | `date_of_birth` | Shown on guardian's managed-patient list |
| `PHARMACY` | `is_active` | `status` ENUM(`pending`, `active`, `deactivated`) | Admin approves a pharmacy after checking its licence |
| `PHARMACY` | — | `licence_no`, `city`, `created_at` | NMRA licence check, and filtering by city |
| `DELIVERY_PERSON` | — | `nic_no`, `vehicle_type`, `vehicle_number` | Admin verifies the rider before approving |
| `ADMIN` | Separate entity (`admin_id` only) | No table — a `USER` row with `role = 'admin'` | It had no columns of its own |

## New tables

| Table | Why |
|---|---|
| `OTP_CODE` | Email verification and password reset codes (only a hash is stored) |
| `SUPPORT_TICKET` | Admin support inbox — messages from the "Contact support" form, or logged by an admin after a phone call |

## Planned — add these when the parent table is built

These depend on tables that don't exist yet, so they aren't in `medreach.sql`.
Whoever builds the parent table adds them.

| Change | Owner | Why |
|---|---|---|
| `RATING.is_hidden` BOOLEAN NOT NULL DEFAULT FALSE | Patient module (builds `RATING`) | Admin can hide a rating without deleting it; hidden ratings don't count toward `PHARMACY.avg_rating` |
| `ORDERS.status` must include `cancelled` | Patient module (builds `ORDERS`) | Patient can cancel before a pharmacy starts preparing |
| New table `DELIVERY_ISSUE` (issue_id, delivery_id FK, type, note, created_at) | Delivery module (builds `DELIVERY`) | Rider reports a problem on a delivery and can edit or withdraw it |

`SUBSTITUTION` needs no change — withdrawing a suggestion deletes the row
while its status is still pending.
