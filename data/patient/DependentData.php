<?php
require_once __DIR__ . '/../../config/database.php';

const MR_DEPENDENT_COLUMNS = 'p.patient_id, u.user_id, u.first_name, u.last_name, u.email, u.phone, p.date_of_birth, p.address, u.created_at,
  (SELECT COUNT(*) FROM PRESCRIPTION pr WHERE pr.patient_id = p.patient_id AND pr.status = \'pending\') AS pending_count
  FROM PATIENT p JOIN `USER` u ON u.user_id = p.user_id';

function mr_dependent_list(int $guardianId): array
{
  $stmt = mr_db()->prepare('SELECT ' . MR_DEPENDENT_COLUMNS . ' WHERE p.managed_by_patient_id = ? ORDER BY u.created_at DESC, p.patient_id DESC');
  $stmt->bind_param('i', $guardianId);
  $stmt->execute();
  return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function mr_dependent_find(int $guardianId, int $patientId): ?array
{
  $stmt = mr_db()->prepare('SELECT ' . MR_DEPENDENT_COLUMNS . ' WHERE p.patient_id = ? AND p.managed_by_patient_id = ?');
  $stmt->bind_param('ii', $patientId, $guardianId);
  $stmt->execute();
  return $stmt->get_result()->fetch_assoc();
}

function mr_patient_mark_guardian(int $patientId): void
{
  $stmt = mr_db()->prepare('UPDATE PATIENT SET is_guardian = TRUE WHERE patient_id = ?');
  $stmt->bind_param('i', $patientId);
  $stmt->execute();
}

function mr_dependent_update(int $guardianId, int $patientId, array $u, array $extra): void
{
  $stmt = mr_db()->prepare(
    'UPDATE `USER` u JOIN PATIENT p ON p.user_id = u.user_id
     SET u.first_name = ?, u.last_name = ?, u.email = ?, u.phone = ?, p.date_of_birth = ?, p.address = ?
     WHERE p.patient_id = ? AND p.managed_by_patient_id = ?'
  );
  $stmt->bind_param('ssssssii', $u['first_name'], $u['last_name'], $u['email'], $u['phone'], $extra['date_of_birth'], $extra['address'], $patientId, $guardianId);
  $stmt->execute();
}

function mr_dependent_delete(int $guardianId, int $patientId): bool
{
  $stmt = mr_db()->prepare(
    'DELETE u FROM `USER` u JOIN PATIENT p ON p.user_id = u.user_id
     WHERE p.patient_id = ? AND p.managed_by_patient_id = ?
       AND NOT EXISTS (SELECT 1 FROM PRESCRIPTION pr WHERE pr.patient_id = p.patient_id AND pr.status = \'pending\')'
  );
  $stmt->bind_param('ii', $patientId, $guardianId);
  $stmt->execute();
  return $stmt->affected_rows > 0;
}
