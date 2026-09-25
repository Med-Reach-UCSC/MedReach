<?php
// MedReach - Admin pharmacy management entry point
require __DIR__ . '/core/Auth.php';
mr_require_role('admin');
require __DIR__ . '/presentation/views/admin/pharmacies.php';
