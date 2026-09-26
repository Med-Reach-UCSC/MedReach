<?php
require_once __DIR__ . '/../../config/database.php';

function mr_admin_user_list(): array
{
  return mr_db()->query(
    'SELECT user_id, first_name, last_name, email, phone, role, status, is_verified, created_at
     FROM `USER` ORDER BY created_at DESC, user_id DESC'
  )->fetch_all(MYSQLI_ASSOC);
}

function mr_admin_user_update(int $userId, string $first, string $last, string $email, string $phone): void
{
  $stmt = mr_db()->prepare('UPDATE `USER` SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE user_id = ?');
  $stmt->bind_param('ssssi', $first, $last, $email, $phone, $userId);
  $stmt->execute();
}

function mr_admin_user_set_status(int $userId, string $status): void
{
  $db = mr_db();
  $stmt = $db->prepare('UPDATE `USER` SET status = ? WHERE user_id = ?');
  $stmt->bind_param('si', $status, $userId);
  $stmt->execute();

  $stmt = $db->prepare(
    'UPDATE PHARMACY SET status = ? WHERE pharmacy_id IN (SELECT pharmacy_id FROM PHARMACIST WHERE user_id = ?)'
  );
  $stmt->bind_param('si', $status, $userId);
  $stmt->execute();
}

function mr_admin_user_delete(int $userId): void
{
  $db = mr_db();
  $db->begin_transaction();
  try {
    $stmt = $db->prepare('SELECT pharmacy_id FROM PHARMACIST WHERE user_id = ?');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $pharmacyId = $stmt->get_result()->fetch_column();

    $stmt = $db->prepare('DELETE FROM `USER` WHERE user_id = ?');
    $stmt->bind_param('i', $userId);
    $stmt->execute();

    if ($pharmacyId) {
      $stmt = $db->prepare(
        'DELETE FROM PHARMACY WHERE pharmacy_id = ? AND NOT EXISTS (SELECT 1 FROM PHARMACIST WHERE pharmacy_id = ?)'
      );
      $stmt->bind_param('ii', $pharmacyId, $pharmacyId);
      $stmt->execute();
    }
    $db->commit();
  } catch (Throwable $e) {
    $db->rollback();
    throw $e;
  }
}
