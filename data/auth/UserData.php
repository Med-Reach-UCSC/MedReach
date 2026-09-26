<?php
require_once __DIR__ . '/../../config/database.php';

function mr_user_find_by_email(string $email): ?array
{
  $stmt = mr_db()->prepare('SELECT * FROM `USER` WHERE email = ?');
  $stmt->bind_param('s', $email);
  $stmt->execute();
  return $stmt->get_result()->fetch_assoc();
}

function mr_account_create(array $u, array $extra): int
{
  $db = mr_db();
  $db->begin_transaction();
  try {
    $stmt = $db->prepare('INSERT INTO `USER` (first_name, last_name, email, phone, password_hash, role, status) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('sssssss', $u['first_name'], $u['last_name'], $u['email'], $u['phone'], $u['password_hash'], $u['role'], $u['status']);
    $stmt->execute();
    $userId = $stmt->insert_id;

    if ($u['role'] === 'patient') {
      $stmt = $db->prepare('INSERT INTO PATIENT (user_id, date_of_birth, address, is_guardian) VALUES (?, ?, ?, ?)');
      $stmt->bind_param('issi', $userId, $extra['date_of_birth'], $extra['address'], $extra['is_guardian']);
      $stmt->execute();
    } elseif ($u['role'] === 'pharmacist') {
      $stmt = $db->prepare('INSERT INTO PHARMACY (name, licence_no, address, city, operating_hours) VALUES (?, ?, ?, ?, ?)');
      $stmt->bind_param('sssss', $extra['pharmacy_name'], $extra['licence_no'], $extra['pharmacy_address'], $extra['city'], $extra['operating_hours']);
      $stmt->execute();
      $pharmacyId = $stmt->insert_id;

      $stmt = $db->prepare('INSERT INTO PHARMACIST (user_id, pharmacy_id) VALUES (?, ?)');
      $stmt->bind_param('ii', $userId, $pharmacyId);
      $stmt->execute();
    } elseif ($u['role'] === 'delivery') {
      $stmt = $db->prepare('INSERT INTO DELIVERY_PERSON (user_id, nic_no, vehicle_type, vehicle_number) VALUES (?, ?, ?, ?)');
      $stmt->bind_param('isss', $userId, $extra['nic_no'], $extra['vehicle_type'], $extra['vehicle_number']);
      $stmt->execute();
    }

    $db->commit();
    return $userId;
  } catch (Throwable $e) {
    $db->rollback();
    throw $e;
  }
}

function mr_user_mark_verified(int $userId): void
{
  $stmt = mr_db()->prepare('UPDATE `USER` SET is_verified = TRUE WHERE user_id = ?');
  $stmt->bind_param('i', $userId);
  $stmt->execute();
}

function mr_user_set_password(int $userId, string $hash): void
{
  $stmt = mr_db()->prepare('UPDATE `USER` SET password_hash = ? WHERE user_id = ?');
  $stmt->bind_param('si', $hash, $userId);
  $stmt->execute();
}

function mr_otp_save(int $userId, string $purpose, string $codeHash, int $ttlSeconds): void
{
  $stmt = mr_db()->prepare(
    'REPLACE INTO OTP_CODE (user_id, purpose, code_hash, expires_at)
     VALUES (?, ?, ?, NOW() + INTERVAL ? SECOND)'
  );
  $stmt->bind_param('issi', $userId, $purpose, $codeHash, $ttlSeconds);
  $stmt->execute();
}

function mr_otp_find(int $userId, string $purpose): ?array
{
  $stmt = mr_db()->prepare(
    'SELECT *, expires_at < NOW() AS is_expired, TIMESTAMPDIFF(SECOND, created_at, NOW()) AS age
     FROM OTP_CODE WHERE user_id = ? AND purpose = ?'
  );
  $stmt->bind_param('is', $userId, $purpose);
  $stmt->execute();
  return $stmt->get_result()->fetch_assoc();
}

function mr_otp_add_attempt(int $userId, string $purpose): void
{
  $stmt = mr_db()->prepare('UPDATE OTP_CODE SET attempts = attempts + 1 WHERE user_id = ? AND purpose = ?');
  $stmt->bind_param('is', $userId, $purpose);
  $stmt->execute();
}

function mr_otp_delete(int $userId, string $purpose): void
{
  $stmt = mr_db()->prepare('DELETE FROM OTP_CODE WHERE user_id = ? AND purpose = ?');
  $stmt->bind_param('is', $userId, $purpose);
  $stmt->execute();
}
