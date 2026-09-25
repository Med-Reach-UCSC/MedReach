<?php
// MedReach - Pharmacist settings entry point
require __DIR__ . '/core/Auth.php';
mr_require_role('pharmacist');
require __DIR__ . '/presentation/views/pharmacy/settings.php';
