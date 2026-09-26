<?php
require_once __DIR__ . '/../../config/database.php';

function mr_patient_id_for_user(int $userId): ?int
{
  $stmt = mr_db()->prepare('SELECT patient_id FROM PATIENT WHERE user_id = ?');
  $stmt->bind_param('i', $userId);
  $stmt->execute();
  $row = $stmt->get_result()->fetch_assoc();
  return $row ? (int) $row['patient_id'] : null;
}

function mr_patient_dependents(int $patientId): array
{
  $stmt = mr_db()->prepare(
    'SELECT p.patient_id, u.first_name, u.last_name
     FROM PATIENT p
     JOIN `USER` u ON u.user_id = p.user_id
     WHERE p.managed_by_patient_id = ?
     ORDER BY u.first_name'
  );
  $stmt->bind_param('i', $patientId);
  $stmt->execute();
  return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function mr_prescription_insert(int $patientId, string $imagePath, ?string $note): int
{
  $stmt = mr_db()->prepare('INSERT INTO PRESCRIPTION (patient_id, image_path, note) VALUES (?, ?, ?)');
  $stmt->bind_param('iss', $patientId, $imagePath, $note);
  $stmt->execute();
  return (int) $stmt->insert_id;
}

function mr_prescription_list(array $patientIds): array
{
  if (!$patientIds) {
    return [];
  }
  $placeholders = implode(',', array_fill(0, count($patientIds), '?'));
  $types = str_repeat('i', count($patientIds));
  $stmt = mr_db()->prepare(
    "SELECT r.prescription_id, r.patient_id, r.image_path, r.note, r.status, r.created_at,
            u.first_name, u.last_name
     FROM PRESCRIPTION r
     JOIN PATIENT p ON p.patient_id = r.patient_id
     JOIN `USER` u ON u.user_id = p.user_id
     WHERE r.patient_id IN ($placeholders)
     ORDER BY r.created_at DESC, r.prescription_id DESC"
  );
  $stmt->bind_param($types, ...$patientIds);
  $stmt->execute();
  return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function mr_prescription_find(int $id): ?array
{
  $stmt = mr_db()->prepare('SELECT prescription_id, patient_id, image_path, note, status FROM PRESCRIPTION WHERE prescription_id = ?');
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $row = $stmt->get_result()->fetch_assoc();
  return $row ?: null;
}

function mr_prescription_update_note(int $id, ?string $note): void
{
  $stmt = mr_db()->prepare("UPDATE PRESCRIPTION SET note = ? WHERE prescription_id = ? AND status = 'pending'");
  $stmt->bind_param('si', $note, $id);
  $stmt->execute();
}

function mr_prescription_cancel(int $id): void
{
  $stmt = mr_db()->prepare("UPDATE PRESCRIPTION SET status = 'cancelled' WHERE prescription_id = ? AND status = 'pending'");
  $stmt->bind_param('i', $id);
  $stmt->execute();
}
