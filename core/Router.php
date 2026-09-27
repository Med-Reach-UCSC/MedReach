<?php
require_once __DIR__ . '/Auth.php';
foreach (glob(__DIR__ . '/../business/*/*.php') as $file) {
  require_once $file;
}

const MR_ROUTES = [
  'index'                => [null, 'landing'],
  'how-it-works'         => [null, 'how-it-works'],
  'policies'             => [null, 'policies'],

  'sign-in'              => [null, 'sign-in', 'mr_page_sign_in'],
  'sign-up'              => [null, 'sign-up', 'mr_page_sign_up'],
  'verify-email'         => [null, 'verify-email', 'mr_page_verify_email'],
  'reset-password'       => [null, 'reset-password', 'mr_page_reset_password'],
  'new-password'         => [null, 'new-password', 'mr_page_new_password'],
  'sign-out'             => [null, null, 'mr_sign_out'],

  'patient-dashboard'    => ['patient', 'patient/dashboard'],
  'guardian-dashboard'   => ['patient', 'patient/guardian-dashboard'],
  'manage-patients'      => ['patient', 'patient/manage-patients'],
  'patient-order'        => ['patient', 'patient/order', 'mr_page_patient_order'],
  'pharmacy-responses'   => ['patient', 'patient/pharmacy-responses'],
  'finalize-order'       => ['patient', 'patient/finalize-order'],
  'order-confirmation'   => ['patient', 'patient/order-confirmation'],
  'track-order-status'   => ['patient', 'patient/track-order-status'],
  'order-history'        => ['patient', 'patient/order-history', 'mr_page_order_history'],
  'prescription-file'    => ['patient', null, 'mr_prescription_file'],
  'nearby-pharmacies'    => ['patient', 'patient/nearby-pharmacies'],
  'payments'             => ['patient', 'patient/payments'],
  'notifications'        => ['patient', 'patient/notifications'],
  'profile'              => ['patient', 'patient/profile'],

  'pharmacy-dashboard'   => ['pharmacist', 'pharmacy/dashboard'],
  'orders'               => ['pharmacist', 'pharmacy/orders'],
  'prescription-request' => ['pharmacist', 'pharmacy/prescription-request'],
  'pharmacy-earnings'    => ['pharmacist', 'pharmacy/earnings'],
  'pharmacy-settings'    => ['pharmacist', 'pharmacy/settings'],

  'delivery-dashboard'   => ['delivery', 'delivery/dashboard'],
  'delivery-details'     => ['delivery', 'delivery/details'],
  'delivery-earnings'    => ['delivery', 'delivery/earnings'],
  'delivery-profile'     => ['delivery', 'delivery/profile'],

  'admin-dashboard'      => ['admin', 'admin/dashboard'],
  'manage-pharmacies'    => ['admin', 'admin/pharmacies'],
  'manage-users'         => ['admin', 'admin/users', 'mr_page_manage_users'],
  'admin-support'        => ['admin', 'admin/support'],
  'admin-ratings'        => ['admin', 'admin/ratings'],
  'admin-settings'       => ['admin', 'admin/settings'],
  'admin-profile'        => ['admin', 'admin/profile'],
];

function mr_dispatch(string $page): void
{
  set_exception_handler(function (Throwable $e) {
    error_log((string) $e);
    mr_error_page(500);
  });
  if (!isset(MR_ROUTES[$page])) {
    mr_error_page(404);
  }
  [$role, $view, $handler] = MR_ROUTES[$page] + [2 => null];

  if ($role !== null) {
    mr_require_role($role);
  }
  mr_render($view, $role, $handler ? $handler() : null);
}

function mr_render(string $view, ?string $role = null, ?array $flash = null, ?int $code = null): void
{
  ob_start();
  require __DIR__ . "/../presentation/views/$view.php";
  $content = ob_get_clean();
  require __DIR__ . '/../presentation/views/layout.php';
}

function mr_error_page(int $code): never
{
  while (ob_get_level()) {
    ob_end_clean();
  }
  http_response_code($code);
  mr_render('error', code: $code);
  exit;
}
