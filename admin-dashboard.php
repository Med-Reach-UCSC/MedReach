<?php
// MedReach - Admin dashboard entry point
require __DIR__ . '/core/Auth.php';
mr_require_role('admin');
require __DIR__ . '/presentation/views/admin/dashboard.php';
