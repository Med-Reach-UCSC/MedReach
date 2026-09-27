<?php
require_once __DIR__ . '/../../config/database.php';

function mr_delivery_rider_id(int $userId): ?int
{
  $stmt = mr_db()->prepare('SELECT delivery_person_id FROM DELIVERY_PERSON WHERE user_id = ?');
  $stmt->bind_param('i', $userId);
  $stmt->execute();
  $row = $stmt->get_result()->fetch_assoc();
  return $row ? (int) $row['delivery_person_id'] : null;
}

function mr_delivery_available_list(): array
{
  return mr_db()->query(
    "SELECT d.delivery_id, d.dropoff_address, d.cod_amount, d.status, d.created_at,
            p.name AS pharmacy_name, p.city AS pharmacy_city
     FROM DELIVERY d
     JOIN PHARMACY p ON p.pharmacy_id = d.pharmacy_id
     WHERE d.status = 'available' AND d.delivery_person_id IS NULL
     ORDER BY d.created_at ASC, d.delivery_id ASC"
  )->fetch_all(MYSQLI_ASSOC);
}

function mr_delivery_mine_list(int $riderId): array
{
  $stmt = mr_db()->prepare(
    "SELECT d.delivery_id, d.dropoff_address, d.cod_amount, d.status, d.created_at,
            p.name AS pharmacy_name, p.city AS pharmacy_city
     FROM DELIVERY d
     JOIN PHARMACY p ON p.pharmacy_id = d.pharmacy_id
     WHERE d.delivery_person_id = ? AND d.status <> 'delivered'
     ORDER BY d.created_at DESC, d.delivery_id DESC"
  );
  $stmt->bind_param('i', $riderId);
  $stmt->execute();
  return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function mr_delivery_find_owned(int $deliveryId, int $riderId): ?array
{
  $stmt = mr_db()->prepare(
    "SELECT d.delivery_id, d.dropoff_address, d.cod_amount, d.status, d.created_at,
            p.name AS pharmacy_name, p.city AS pharmacy_city, p.address AS pharmacy_address
     FROM DELIVERY d
     JOIN PHARMACY p ON p.pharmacy_id = d.pharmacy_id
     WHERE d.delivery_id = ? AND d.delivery_person_id = ?"
  );
  $stmt->bind_param('ii', $deliveryId, $riderId);
  $stmt->execute();
  $row = $stmt->get_result()->fetch_assoc();
  return $row ?: null;
}

// Create (accept): claims an unassigned available task for this rider in one atomic query.
function mr_delivery_accept(int $deliveryId, int $riderId): int
{
  $stmt = mr_db()->prepare(
    "UPDATE DELIVERY SET delivery_person_id = ?, status = 'assigned'
     WHERE delivery_id = ? AND delivery_person_id IS NULL AND status = 'available'"
  );
  $stmt->bind_param('ii', $riderId, $deliveryId);
  $stmt->execute();
  return $stmt->affected_rows;
}

// Update: moves status forward by exactly one step. $fromStatus is always read from the
// database by the caller, never trusted from the client, so this cannot skip or rewind steps.
function mr_delivery_advance(int $deliveryId, int $riderId, string $fromStatus, string $toStatus): int
{
  $stmt = mr_db()->prepare(
    "UPDATE DELIVERY SET status = ?
     WHERE delivery_id = ? AND delivery_person_id = ? AND status = ?"
  );
  $stmt->bind_param('siis', $toStatus, $deliveryId, $riderId, $fromStatus);
  $stmt->execute();
  return $stmt->affected_rows;
}

// Delete (unassign): only while still 'assigned', enforced in the WHERE clause.
function mr_delivery_release(int $deliveryId, int $riderId): int
{
  $stmt = mr_db()->prepare(
    "UPDATE DELIVERY SET delivery_person_id = NULL, status = 'available'
     WHERE delivery_id = ? AND delivery_person_id = ? AND status = 'assigned'"
  );
  $stmt->bind_param('ii', $deliveryId, $riderId);
  $stmt->execute();
  return $stmt->affected_rows;
}

