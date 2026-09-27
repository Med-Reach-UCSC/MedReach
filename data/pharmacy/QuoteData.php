<?php
require_once __DIR__ . '/../../config/database.php';

function mr_pharmacy_id_for_user(int $userId): ?int
{
  $stmt = mr_db()->prepare('SELECT pharmacy_id FROM PHARMACIST WHERE user_id = ?');
  $stmt->bind_param('i', $userId);
  $stmt->execute();
  $id = $stmt->get_result()->fetch_column();
  return $id !== false ? (int) $id : null;
}

function mr_pending_prescriptions(int $pharmacyId): array
{
  $status = 'pending';
  $stmt = mr_db()->prepare(
    'SELECT pr.prescription_id, pr.image_path, pr.note, pr.created_at,
            u.first_name AS patient_first_name,
            b.quoted_items, b.quoted_total, b.status AS quote_status
     FROM PRESCRIPTION pr
     JOIN PATIENT pa ON pa.patient_id = pr.patient_id
     JOIN `USER` u ON u.user_id = pa.user_id
     LEFT JOIN BROADCAST b ON b.prescription_id = pr.prescription_id AND b.pharmacy_id = ?
     WHERE pr.status = ?
     ORDER BY pr.created_at DESC'
  );
  $stmt->bind_param('is', $pharmacyId, $status);
  $stmt->execute();
  return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function mr_prescription_for_pharmacy(int $prescriptionId, int $pharmacyId): ?array
{
  $status = 'pending';
  $stmt = mr_db()->prepare(
    'SELECT pr.prescription_id, pr.image_path, pr.note, pr.created_at,
            u.first_name AS patient_first_name, u.last_name AS patient_last_name,
            b.quoted_items, b.quoted_total, b.status AS quote_status
     FROM PRESCRIPTION pr
     JOIN PATIENT pa ON pa.patient_id = pr.patient_id
     JOIN `USER` u ON u.user_id = pa.user_id
     LEFT JOIN BROADCAST b ON b.prescription_id = pr.prescription_id AND b.pharmacy_id = ?
     WHERE pr.prescription_id = ? AND pr.status = ?'
  );
  $stmt->bind_param('iis', $pharmacyId, $prescriptionId, $status);
  $stmt->execute();
  $row = $stmt->get_result()->fetch_assoc();
  return $row ?: null;
}

function mr_quote_create(int $prescriptionId, int $pharmacyId, string $items, float $total): void
{
  $stmt = mr_db()->prepare(
    'INSERT INTO BROADCAST (prescription_id, pharmacy_id, quoted_items, quoted_total, status)
     VALUES (?, ?, ?, ?, "quoted")
     ON DUPLICATE KEY UPDATE quoted_items = VALUES(quoted_items), quoted_total = VALUES(quoted_total), status = "quoted"'
  );
  $stmt->bind_param('iisd', $prescriptionId, $pharmacyId, $items, $total);
  $stmt->execute();
}

function mr_quote_update(int $prescriptionId, int $pharmacyId, string $items, float $total): void
{
  $status = 'quoted';
  $stmt = mr_db()->prepare(
    'UPDATE BROADCAST SET quoted_items = ?, quoted_total = ? WHERE prescription_id = ? AND pharmacy_id = ? AND status = ?'
  );
  $stmt->bind_param('sdiis', $items, $total, $prescriptionId, $pharmacyId, $status);
  $stmt->execute();
}

function mr_quote_withdraw(int $prescriptionId, int $pharmacyId): void
{
  $newStatus = 'withdrawn';
  $current   = 'quoted';
  $stmt = mr_db()->prepare(
    'UPDATE BROADCAST SET status = ? WHERE prescription_id = ? AND pharmacy_id = ? AND status = ?'
  );
  $stmt->bind_param('siis', $newStatus, $prescriptionId, $pharmacyId, $current);
  $stmt->execute();
}
