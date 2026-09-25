<?php
// MedReach - Pharmacist dashboard entry point
require __DIR__ . '/core/Auth.php';
mr_require_role('pharmacist');
require __DIR__ . '/presentation/views/pharmacy/dashboard.php';
