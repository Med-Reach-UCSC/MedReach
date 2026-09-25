-- MedReach schema (follows docs/UML Diagrams/MedReach_ER.drawio)
-- Remaining entities (PHARMACY, PHARMACIST, DELIVERY_PERSON, ADMIN, ...) are added by each module owner.

CREATE TABLE `USER` (
  user_id       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  first_name    VARCHAR(50)  NOT NULL,
  last_name     VARCHAR(50)  NOT NULL,
  email         VARCHAR(255) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  phone         VARCHAR(20)  NOT NULL,
  role          ENUM('patient', 'pharmacist', 'delivery', 'admin') NOT NULL,
  is_active     BOOLEAN NOT NULL DEFAULT TRUE,  -- FALSE = deactivated by admin
  is_verified   BOOLEAN NOT NULL DEFAULT FALSE, -- email confirmed with a one-time code
  created_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- USER "is a" PATIENT. A guardian is a patient with is_guardian = TRUE;
-- patients they manage point back to them through managed_by_patient_id.
CREATE TABLE PATIENT (
  patient_id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id               INT UNSIGNED NOT NULL UNIQUE,
  address               VARCHAR(255) NULL,
  is_guardian           BOOLEAN NOT NULL DEFAULT FALSE,
  managed_by_patient_id INT UNSIGNED NULL,
  FOREIGN KEY (user_id) REFERENCES `USER` (user_id) ON DELETE CASCADE,
  FOREIGN KEY (managed_by_patient_id) REFERENCES PATIENT (patient_id) ON DELETE SET NULL
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
