<?php
require_once __DIR__ . '/../auth/Account.php';
require_once __DIR__ . '/../../data/admin/UserAdminData.php';

const MR_STATUS_LABELS = [
  'active'      => 'Active',
  'pending'     => 'Pending',
  'deactivated' => 'Suspended',
];

function mr_page_manage_users(): ?array
{
  return mr_form('mr_handle_manage_users');
}

function mr_admin_users(): array
{
  return array_map(fn (array $u) => $u + [
    'name'     => "{$u['first_name']} {$u['last_name']}",
    'initials' => mb_strtoupper(mb_substr($u['first_name'], 0, 1) . mb_substr($u['last_name'], 0, 1)),
    'code'     => sprintf('U-%03d', $u['user_id']),
    'is_self'  => (int) $u['user_id'] === $_SESSION['user_id'],
  ], mr_admin_user_list());
}

function mr_handle_manage_users(array $in): ?array
{
  $action = $in['action'] ?? '';
  if ($action === 'create') {
    return mr_admin_create_user($in);
  }

  $user = mr_user_find((int) ($in['user_id'] ?? 0));
  if (!$user) {
    return mr_error('That account no longer exists.');
  }
  $name = "{$user['first_name']} {$user['last_name']}";
  if ((int) $user['user_id'] === $_SESSION['user_id'] && $action !== 'update') {
    return mr_error("You can't suspend or delete your own account.");
  }

  switch ($action) {
    case 'update':
      return mr_admin_update_user($user, $in);
    case 'approve':
    case 'reactivate':
      mr_admin_user_set_status((int) $user['user_id'], 'active');
      if ($user['status'] === 'pending') {
        mr_send_mail($user['email'], 'Your MedReach account is approved', "Hi {$user['first_name']},\n\nAn admin approved your account. You can sign in now.");
      }
      return mr_admin_done("$name can sign in now.");
    case 'suspend':
      mr_admin_user_set_status((int) $user['user_id'], 'deactivated');
      return mr_admin_done("$name has been suspended.");
    case 'delete':
      mr_admin_user_delete((int) $user['user_id']);
      return mr_admin_done("$name's account was deleted.");
  }
  return mr_error('Unknown action.');
}

function mr_admin_create_user(array $in): array
{
  [$error, $u, $extra] = mr_account_input($in, MR_ROLE_LABELS);
  if ($error) {
    return mr_error($error) + ['modal' => 'mr-user-create-modal'];
  }

  $id = mr_account_register($u + [
    'password_hash' => password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT),
    'status'        => 'active',
    'is_verified'   => 1,
  ], $extra);
  if (is_array($id)) {
    return $id + ['modal' => 'mr-user-create-modal'];
  }
  mr_admin_user_set_status($id, 'active');
  mr_send_mail($u['email'], 'Your MedReach account', "Hi {$u['first_name']},\n\nAn admin created a MedReach account for you. "
    . 'To choose your password, open the sign-in page and use "Forgot password" with this email address.');
  return mr_admin_done("Account created for {$u['first_name']} {$u['last_name']}.");
}

function mr_admin_update_user(array $user, array $in): array
{
  $first = trim($in['first_name'] ?? '');
  $last  = trim($in['last_name'] ?? '');
  $email = strtolower(trim($in['email'] ?? ''));
  $phone = trim($in['phone'] ?? '');
  $owner = mr_valid_email($email) ? mr_user_find_by_email($email) : null;

  $error = match (true) {
    !mr_valid_name($first)  => 'Enter a valid first name, using letters only.',
    !mr_valid_name($last)   => 'Enter a valid last name, using letters only.',
    !mr_valid_email($email) => 'Enter a valid email address, e.g. nimal@example.com.',
    !mr_valid_phone($phone) => 'Enter a valid phone number, e.g. 071 234 5678.',
    $owner && (int) $owner['user_id'] !== (int) $user['user_id'] => 'Another account already uses this email.',
    default => null,
  };
  if ($error) {
    return mr_error($error) + ['modal' => 'mr-user-edit-modal'];
  }

  mr_admin_user_update((int) $user['user_id'], $first, $last, $email, $phone);
  if ((int) $user['user_id'] === $_SESSION['user_id']) {
    $_SESSION['name'] = $first;
  }
  return mr_admin_done("$first $last's details were updated.");
}

function mr_admin_done(string $text): never
{
  mr_flash('success', $text);
  mr_redirect('manage-users.php');
}
