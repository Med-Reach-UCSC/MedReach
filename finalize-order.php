<?php
// MedReach - Patient finalize order entry point
require __DIR__ . '/core/Auth.php';
mr_require_role('patient');
require __DIR__ . '/presentation/views/patient/finalize-order.php';
