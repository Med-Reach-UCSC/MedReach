<?php
// MedReach - Patient dashboard entry point
require __DIR__ . '/core/Auth.php';
mr_require_role('patient');
require __DIR__ . '/presentation/views/patient/dashboard.php';
