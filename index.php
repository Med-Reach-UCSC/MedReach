<?php
require __DIR__ . '/core/Router.php';
mr_dispatch($_GET['page'] ?? 'index');
