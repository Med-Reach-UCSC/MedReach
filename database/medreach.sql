-- MedReach schema (follows docs/UML Diagrams/MedReach_ER.drawio)
-- Remaining entities (PRESCRIPTION, ORDERS, DELIVERY, ...) are added by each module owner.

-- status: patients are active once their email is verified; pharmacists and
-- delivery people stay 'pending' until an admin approves them.
CREATE TABLE `USER` (
  user_id       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  first_name    VARCHAR(50)  NOT NULL,
  last_name     VARCHAR(50)  NOT NULL,
  email         VARCHAR(255) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  phone         VARCHAR(20)  NOT NULL,
  role          ENUM('patient', 'pharmacist', 'delivery', 'admin') NOT NULL,
  status        ENUM('pending', 'active', 'deactivated') NOT NULL DEFAULT 'active',
  is_verified   BOOLEAN NOT NULL DEFAULT FALSE, -- email confirmed with a one-time code
  created_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- USER "is a" PATIENT. A guardian is a patient with is_guardian = TRUE;
-- patients they manage point back to them through managed_by_patient_id.
CREATE TABLE PATIENT (
  patient_id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id               INT UNSIGNED NOT NULL UNIQUE,
  date_of_birth         DATE NULL,
  address               VARCHAR(255) NULL,
  is_guardian           BOOLEAN NOT NULL DEFAULT FALSE,
  managed_by_patient_id INT UNSIGNED NULL,
  FOREIGN KEY (user_id) REFERENCES `USER` (user_id) ON DELETE CASCADE,
  FOREIGN KEY (managed_by_patient_id) REFERENCES PATIENT (patient_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- A pharmacy is registered by its first pharmacist and starts 'pending'
-- until an admin checks the NMRA licence.
CREATE TABLE PHARMACY (
  pharmacy_id     INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name            VARCHAR(100) NOT NULL,
  licence_no      VARCHAR(30)  NOT NULL UNIQUE, -- NMRA pharmacy licence
  address         VARCHAR(255) NOT NULL,
  city            VARCHAR(50)  NOT NULL,
  operating_hours VARCHAR(100) NULL,
  avg_rating      DECIMAL(2,1) NULL,
  status          ENUM('pending', 'active', 'deactivated') NOT NULL DEFAULT 'pending',
  created_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- USER "is a" PHARMACIST; PHARMACY employs many pharmacists.
CREATE TABLE PHARMACIST (
  pharmacist_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id       INT UNSIGNED NOT NULL UNIQUE,
  pharmacy_id   INT UNSIGNED NOT NULL,
  FOREIGN KEY (user_id) REFERENCES `USER` (user_id) ON DELETE CASCADE,
  FOREIGN KEY (pharmacy_id) REFERENCES PHARMACY (pharmacy_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- USER "is a" DELIVERY_PERSON. NIC and vehicle details let the admin verify them.
CREATE TABLE DELIVERY_PERSON (
  delivery_person_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id            INT UNSIGNED NOT NULL UNIQUE,
  nic_no             VARCHAR(12) NOT NULL UNIQUE,
  vehicle_type       ENUM('motorbike', 'three_wheeler', 'car', 'van') NOT NULL,
  vehicle_number     VARCHAR(15) NOT NULL,
  is_available       BOOLEAN NOT NULL DEFAULT FALSE, -- on-duty toggle
  FOREIGN KEY (user_id) REFERENCES `USER` (user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- One-time codes for email verification and password reset.
-- Only a hash of the code is stored, never the code itself.
CREATE TABLE OTP_CODE (
  user_id    INT UNSIGNED NOT NULL,
  purpose    ENUM('verify_email', 'reset_password') NOT NULL,
  code_hash  VARCHAR(255) NOT NULL,
  attempts   TINYINT UNSIGNED NOT NULL DEFAULT 0,
  expires_at DATETIME NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id, purpose),
  FOREIGN KEY (user_id) REFERENCES `USER` (user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
