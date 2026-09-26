-- MedReach - local development accounts, one per role. Password for all: MedReach@123
-- Safe to re-run: existing rows are reset to these values.

INSERT INTO `USER` (first_name, last_name, email, password_hash, phone, role, status, is_verified) VALUES
  ('Nimal',  'Perera',   'patient@medreach.test',    '$2y$10$TYcDGCuzqecCND17CCEtXefzuGtbjphMffH3oDnAwCx/aT.pe5nb.', '071 234 5678', 'patient',    'active', TRUE),
  ('Hasini', 'Fernando', 'pharmacist@medreach.test', '$2y$10$TYcDGCuzqecCND17CCEtXefzuGtbjphMffH3oDnAwCx/aT.pe5nb.', '071 345 6789', 'pharmacist', 'active', TRUE),
  ('Kasun',  'Perera',   'delivery@medreach.test',   '$2y$10$TYcDGCuzqecCND17CCEtXefzuGtbjphMffH3oDnAwCx/aT.pe5nb.', '071 456 7890', 'delivery',   'active', TRUE),
  ('Dilani', 'Perera',   'admin@medreach.test',      '$2y$10$TYcDGCuzqecCND17CCEtXefzuGtbjphMffH3oDnAwCx/aT.pe5nb.', '071 567 8901', 'admin',      'active', TRUE)
ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash), status = 'active', is_verified = TRUE;

-- Nimal is a guardian so the family pages have an account to show.
INSERT INTO PATIENT (user_id, address, is_guardian)
SELECT user_id, '12 Galle Road, Colombo 03', TRUE FROM `USER` WHERE email = 'patient@medreach.test'
ON DUPLICATE KEY UPDATE is_guardian = TRUE;

INSERT INTO PHARMACY (name, licence_no, address, city, operating_hours, status) VALUES
  ('Apex Care Pharmacy', 'PH-2024-0192', '45 Ward Place', 'Colombo 07', '8 AM – 10 PM', 'active')
ON DUPLICATE KEY UPDATE status = 'active';

INSERT INTO PHARMACIST (user_id, pharmacy_id)
SELECT u.user_id, p.pharmacy_id FROM `USER` u, PHARMACY p
WHERE u.email = 'pharmacist@medreach.test' AND p.licence_no = 'PH-2024-0192'
ON DUPLICATE KEY UPDATE pharmacy_id = VALUES(pharmacy_id);

INSERT INTO DELIVERY_PERSON (user_id, nic_no, vehicle_type, vehicle_number)
SELECT user_id, '199512345678', 'motorbike', 'WP BAB-1234' FROM `USER` WHERE email = 'delivery@medreach.test'
ON DUPLICATE KEY UPDATE nic_no = VALUES(nic_no);
