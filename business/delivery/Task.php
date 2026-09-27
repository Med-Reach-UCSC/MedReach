<?php
require_once __DIR__ . '/../../data/delivery/TaskData.php';

const MR_DELIVERY_STATUS_LABELS = [
  'available' => 'Available',
  'assigned'  => 'Assigned',
  'picked_up' => 'Picked Up',
  'delivered' => 'Delivered',
];

// Forward-only workflow: each status may only move to the one listed here.
const MR_DELIVERY_NEXT_STATUS = [
  'assigned'  => 'picked_up',
  'picked_up' => 'delivered',
];

function mr_page_delivery_dashboard(): ?array
{
  return mr_form('mr_handle_delivery_dashboard');
}

function mr_page_delivery_details(): ?array
{
  return mr_form('mr_handle_delivery_details');
}

function mr_delivery_current_rider_id(): ?int
{
  static $riderId = null;
  static $looked_up = false;
  if (!$looked_up) {
    $riderId   = mr_delivery_rider_id((int) $_SESSION['user_id']);
    $looked_up = true;
  }
  return $riderId;
}

function mr_valid_delivery_id(mixed $value): ?int
{
  if (!is_string($value) && !is_int($value)) {
    return null;
  }
  $str = (string) $value;
  if (!ctype_digit($str)) {
    return null;
  }
  $id = (int) $str;
  return $id > 0 ? $id : null;
}

function mr_delivery_view_row(array $d): array
{
  return $d + [
    'status_label' => MR_DELIVERY_STATUS_LABELS[$d['status']] ?? $d['status'],
    'cod_display'  => number_format((float) $d['cod_amount'], 2),
  ];
}

function mr_delivery_available_tasks(): array
{
  return array_map('mr_delivery_view_row', mr_delivery_available_list());
}

function mr_delivery_my_tasks(): array
{
  $riderId = mr_delivery_current_rider_id();
  if (!$riderId) {
    return [];
  }
  return array_map('mr_delivery_view_row', mr_delivery_mine_list($riderId));
}

// Used by the details page. Ownership is enforced here (and again in SQL), so a rider
// can never view or act on another rider's task, even by editing the URL.
function mr_delivery_task_for_view(int $deliveryId): ?array
{
  $riderId = mr_delivery_current_rider_id();
  if (!$riderId || $deliveryId < 1) {
    return null;
  }
  $task = mr_delivery_find_owned($deliveryId, $riderId);
  return $task ? mr_delivery_view_row($task) : null;
}

function mr_handle_delivery_dashboard(array $in): ?array
{
  switch ($in['action'] ?? '') {
    case 'accept':
      return mr_delivery_action_accept($in);
  }
  return mr_error('Unknown action.');
}

function mr_handle_delivery_details(array $in): ?array
{
  switch ($in['action'] ?? '') {
    case 'advance':
      return mr_delivery_action_advance($in);
    case 'release':
      return mr_delivery_action_release($in);
  }
  return mr_error('Unknown action.');
}

// Create: accept an available task. Rejects a tampered/unknown id, a task already taken
// by someone else, and requests from a session with no delivery-person profile.
function mr_delivery_action_accept(array $in): array
{
  $deliveryId = mr_valid_delivery_id($in['delivery_id'] ?? null);
  if (!$deliveryId) {
    return mr_error('That delivery task is invalid.');
  }
  $riderId = mr_delivery_current_rider_id();
  if (!$riderId) {
    return mr_error('Your delivery profile could not be found.');
  }
  if (mr_delivery_accept($deliveryId, $riderId) === 0) {
    return mr_error('This task is no longer available.');
  }
  return mr_delivery_done('Task accepted. It is now in "My deliveries".', 'delivery-dashboard.php');
}

// Update: move status forward exactly one step. The next status is always computed from
// the current status stored in the database, never from client input.
function mr_delivery_action_advance(array $in): array
{
  $deliveryId = mr_valid_delivery_id($in['delivery_id'] ?? null);
  if (!$deliveryId) {
    return mr_error('That delivery task is invalid.');
  }
  $riderId = mr_delivery_current_rider_id();
  if (!$riderId) {
    return mr_error('Your delivery profile could not be found.');
  }
  $task = mr_delivery_find_owned($deliveryId, $riderId);
  if (!$task) {
    return mr_error("That task isn't assigned to you.");
  }
  $from = $task['status'];
  $to   = MR_DELIVERY_NEXT_STATUS[$from] ?? null;
  if (!$to) {
    return mr_error('This task is already delivered.');
  }
  if (mr_delivery_advance($deliveryId, $riderId, $from, $to) === 0) {
    return mr_error('This task already changed. Refresh the page and try again.');
  }
  return mr_delivery_done('Marked as ' . MR_DELIVERY_STATUS_LABELS[$to] . '.', 'delivery-details.php?id=' . $deliveryId);
}

// Delete (unassign): only while still 'assigned', enforced in the WHERE clause of the update.
function mr_delivery_action_release(array $in): array
{
  $deliveryId = mr_valid_delivery_id($in['delivery_id'] ?? null);
  if (!$deliveryId) {
    return mr_error('That delivery task is invalid.');
  }
  $riderId = mr_delivery_current_rider_id();
  if (!$riderId) {
    return mr_error('Your delivery profile could not be found.');
  }
  if (mr_delivery_release($deliveryId, $riderId) === 0) {
    return mr_error("This task can't be released. It may already be picked up, delivered, or not yours.");
  }
  return mr_delivery_done('Task released back to the available list.', 'delivery-dashboard.php');
}

function mr_delivery_done(string $text, string $redirectTo): never
{
  mr_flash('success', $text);
  mr_redirect($redirectTo);
}
