<?php
require_once __DIR__ . '/../auth/Account.php';
require_once __DIR__ . '/Prescription.php';
require_once __DIR__ . '/../../data/patient/DependentData.php';

function mr_page_manage_patients(): ?array
{
  return mr_form('mr_handle_manage_patients');
}

function mr_dependents(): array
{
  return array_map(fn (array $p) => $p + [
    'name'     => "{$p['first_name']} {$p['last_name']}",
    'initials' => mb_strtoupper(mb_substr($p['first_name'], 0, 1) . mb_substr($p['last_name'], 0, 1)),
    'code'     => sprintf('PT-%04d', $p['patient_id']),
    'age'      => $p['date_of_birth'] ? (new DateTime($p['date_of_birth']))->diff(new DateTime())->y : null,
  ], mr_dependent_list(mr_patient_id()));
}

function mr_handle_manage_patients(array $in): ?array
{
  $guardianId = mr_patient_id();
  $action = $in['action'] ?? '';
  if ($action === 'create') {
    return mr_dependent_add($guardianId, $in);
  }

  $patient = mr_dependent_find($guardianId, (int) ($in['patient_id'] ?? 0));
  if (!$patient) {
    return mr_error('That patient is not on your family list.');
  }
  $name = "{$patient['first_name']} {$patient['last_name']}";

  switch ($action) {
    case 'update':
      return mr_dependent_edit($guardianId, $patient, $in);
    case 'delete':
      if ($patient['pending_count'] > 0 || !mr_dependent_delete($guardianId, (int) $patient['patient_id'])) {
        return mr_error("$name has a pending prescription. You can remove them once it is fulfilled or cancelled.");
      }
      return mr_dependent_done("$name was removed from your family list.");
  }
  return mr_error('Unknown action.');
}

function mr_dependent_add(int $guardianId, array $in): array
{
  [$error, $u, $extra] = mr_account_input(['role' => 'patient'] + $in, MR_PUBLIC_ROLES);
  if ($error) {
    return mr_error($error) + ['modal' => 'mr-patient-create-modal'];
  }

  mr_account_create($u + [
    'password_hash' => password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT),
    'status'        => 'active',
    'is_verified'   => 1,
  ], ['is_guardian' => 0, 'managed_by_patient_id' => $guardianId] + $extra);
  mr_patient_mark_guardian($guardianId);
  return mr_dependent_done("{$u['first_name']} {$u['last_name']} was added to your family list.");
}

function mr_dependent_edit(int $guardianId, array $patient, array $in): array
{
  $u = [
    'first_name' => trim($in['first_name'] ?? ''),
    'last_name'  => trim($in['last_name'] ?? ''),
    'email'      => strtolower(trim($in['email'] ?? '')),
    'phone'      => trim($in['phone'] ?? ''),
  ];
  $owner = mr_valid_email($u['email']) ? mr_user_find_by_email($u['email']) : null;

  $error = match (true) {
    !mr_valid_name($u['first_name']) => 'Enter a valid first name, using letters only.',
    !mr_valid_name($u['last_name'])  => 'Enter a valid last name, using letters only.',
    !mr_valid_email($u['email'])     => 'Enter a valid email address, e.g. nimal@example.com.',
    !mr_valid_phone($u['phone'])     => 'Enter a valid phone number, e.g. 071 234 5678.',
    $owner && (int) $owner['user_id'] !== (int) $patient['user_id'] => 'Another account already uses this email.',
    default => null,
  };
  [$error, $extra] = $error ? [$error, []] : mr_sign_up_extra('patient', $in);
  if ($error) {
    return mr_error($error) + ['modal' => 'mr-patient-edit-modal'];
  }

  mr_dependent_update($guardianId, (int) $patient['patient_id'], $u, $extra);
  return mr_dependent_done("{$u['first_name']} {$u['last_name']}'s details were updated.");
}

function mr_dependent_done(string $text): never
{
  mr_flash('success', $text);
  mr_redirect('manage-patients.php');
}
