<?php
require_once __DIR__ . '/../../data/patient/PrescriptionData.php';

const MR_RX_MAX_BYTES = 5 * 1024 * 1024;
const MR_RX_MIME_EXT = [
  'image/jpeg'      => 'jpg',
  'image/png'       => 'png',
  'application/pdf' => 'pdf',
];

function mr_page_patient_order(): ?array
{
  return mr_form('mr_handle_prescription_upload');
}

function mr_page_order_history(): ?array
{
  return mr_form('mr_handle_prescription_action');
}

function mr_patient_id(): int
{
  static $id = null;
  if ($id === null) {
    $id = mr_patient_id_for_user((int) $_SESSION['user_id']);
    if ($id === null) {
      mr_error_page(404);
    }
  }
  return $id;
}

function mr_patient_allowed_ids(): array
{
  $own = mr_patient_id();
  $dependents = array_map(fn ($d) => (int) $d['patient_id'], mr_patient_dependents($own));
  return array_merge([$own], $dependents);
}

function mr_patient_upload_targets(): array
{
  $own = mr_patient_id();
  $targets = [['patient_id' => $own, 'label' => 'Myself']];
  foreach (mr_patient_dependents($own) as $d) {
    $targets[] = ['patient_id' => (int) $d['patient_id'], 'label' => "{$d['first_name']} {$d['last_name']}"];
  }
  return $targets;
}

function mr_patient_prescriptions(): array
{
  $own = mr_patient_id();
  $rows = mr_prescription_list(mr_patient_allowed_ids());
  return array_map(fn ($r) => $r + [
    'owner_label' => (int) $r['patient_id'] === $own ? 'Myself' : "{$r['first_name']} {$r['last_name']}",
  ], $rows);
}

function mr_handle_prescription_upload(array $in): array
{
  $own = mr_patient_id();
  $allowed = mr_patient_allowed_ids();
  $targetId = (int) ($in['patient_id'] ?? $own);
  if (!in_array($targetId, $allowed, true)) {
    return mr_error('Choose who this prescription is for.');
  }

  $note = trim($in['note'] ?? '');
  if (mb_strlen($note) > 500) {
    return mr_error('The note is too long. Keep it under 500 characters.');
  }

  $file = $_FILES['prescription'] ?? null;
  if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
    return mr_error('Choose a prescription file to upload.');
  }
  if ($file['error'] !== UPLOAD_ERR_OK) {
    return mr_error('The file could not be uploaded. Please try again.');
  }
  if ($file['size'] > MR_RX_MAX_BYTES) {
    return mr_error('The file is larger than 5 MB. Choose a smaller file.');
  }

  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime = finfo_file($finfo, $file['tmp_name']);
  finfo_close($finfo);
  $ext = MR_RX_MIME_EXT[$mime] ?? null;
  if (!$ext) {
    return mr_error('Only JPG, PNG or PDF files are accepted.');
  }

  $dir = __DIR__ . '/../../uploads/prescriptions';
  if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
  }
  $name = bin2hex(random_bytes(16)) . '.' . $ext;
  if (!move_uploaded_file($file['tmp_name'], "$dir/$name")) {
    return mr_error('The file could not be saved. Please try again.');
  }

  mr_prescription_insert($targetId, $name, $note !== '' ? $note : null);
  mr_flash('success', "Prescription uploaded. We'll notify nearby pharmacies.");
  mr_redirect('order-history.php');
}

function mr_handle_prescription_action(array $in): array
{
  $action = $in['action'] ?? '';
  $id = (int) ($in['prescription_id'] ?? 0);
  $allowed = mr_patient_allowed_ids();
  $rx = mr_prescription_find($id);

  if (!$rx || !in_array((int) $rx['patient_id'], $allowed, true)) {
    return mr_error('That request no longer exists.');
  }
  if ($rx['status'] !== 'pending') {
    return mr_error('This request can no longer be changed.');
  }

  switch ($action) {
    case 'update_note':
      $note = trim($in['note'] ?? '');
      if (mb_strlen($note) > 500) {
        return mr_error('The note is too long. Keep it under 500 characters.') + ['modal' => 'mr-edit-note-modal'];
      }
      mr_prescription_update_note($id, $note !== '' ? $note : null);
      mr_flash('success', 'Note updated.');
      mr_redirect('order-history.php');

    case 'cancel':
      mr_prescription_cancel($id);
      mr_flash('success', 'Request cancelled.');
      mr_redirect('order-history.php');
  }

  return mr_error('Unknown action.');
}

function mr_prescription_file(): never
{
  $id = (int) ($_GET['id'] ?? 0);
  $rx = mr_prescription_find($id);
  $allowed = mr_patient_allowed_ids();
  if (!$rx || !in_array((int) $rx['patient_id'], $allowed, true)) {
    mr_error_page(404);
  }

  $path = __DIR__ . "/../../uploads/prescriptions/{$rx['image_path']}";
  if (!is_file($path)) {
    mr_error_page(404);
  }

  $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
  $types = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'pdf' => 'application/pdf'];

  while (ob_get_level()) {
    ob_end_clean();
  }
  header('Content-Type: ' . ($types[$ext] ?? 'application/octet-stream'));
  header('Content-Length: ' . filesize($path));
  header('Content-Disposition: inline; filename="prescription-' . $id . '.' . $ext . '"');
  readfile($path);
  exit;
}
