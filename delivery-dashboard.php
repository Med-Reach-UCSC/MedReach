<?php
// MedReach - Delivery rider dashboard entry point
require __DIR__ . '/core/Auth.php';
mr_require_role('delivery');
require __DIR__ . '/presentation/views/delivery/dashboard.php';
