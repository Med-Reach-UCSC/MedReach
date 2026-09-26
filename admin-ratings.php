<?php
// MedReach - Admin ratings moderation entry point
require __DIR__ . '/core/Auth.php';
mr_require_role('admin');
require __DIR__ . '/presentation/views/admin/ratings.php';
