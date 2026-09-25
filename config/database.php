<?php
// MedReach - Environment + database connection. Secrets live in the
// git-ignored .env at the project root (see .env.example).

function mr_env(string $key, string $default = ''): string
{
  static $env = null;
  if ($env === null) {
    $file = __DIR__ . '/../.env';
    $env = is_file($file) ? parse_ini_file($file, false, INI_SCANNER_RAW) : [];
  }
  return $env[$key] ?? (getenv($key) ?: $default);
}

function mr_db(): mysqli
{
  static $conn = null;
  if ($conn === null) {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli(mr_env('DB_HOST', 'localhost'), mr_env('DB_USER'), mr_env('DB_PASS'), mr_env('DB_NAME', 'medreach'));
    $conn->set_charset('utf8mb4');
  }
  return $conn;
}
