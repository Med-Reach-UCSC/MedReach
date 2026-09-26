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
  'patient-order'        => ['patient', 'patient/order'],
  'pharmacy-responses'   => ['patient', 'patient/pharmacy-responses'],
  'finalize-order'       => ['patient', 'patient/finalize-order'],
  'order-confirmation'   => ['patient', 'patient/order-confirmation'],
  'track-order-status'   => ['patient', 'patient/track-order-status'],
  'order-history'        => ['patient', 'patient/order-history'],
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

  'admin-dashboard'      => ['admin', 'admin/dashboard'],
  'manage-pharmacies'    => ['admin', 'admin/pharmacies'],
  'manage-users'         => ['admin', 'admin/users'],
  'admin-support'        => ['admin', 'admin/support'],
  'admin-ratings'        => ['admin', 'admin/ratings'],
  'admin-settings'       => ['admin', 'admin/settings'],
];

function mr_dispatch(string $page): void
{
  if (!isset(MR_ROUTES[$page])) {
    http_response_code(404);
    exit('Page not found');
  }
  [$role, $view, $handler] = MR_ROUTES[$page] + [2 => null];

  if ($role !== null) {
    mr_require_role($role);
  }
  $flash = $handler ? $handler() : null;

  ob_start();
  require __DIR__ . "/../presentation/views/$view.php";
  $content = ob_get_clean();
  require __DIR__ . '/../presentation/views/layout.php';
}
