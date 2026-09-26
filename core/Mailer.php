<?php
require_once __DIR__ . '/../config/database.php';

function mr_send_mail(string $to, string $subject, string $text): bool
{
  $key = mr_env('RESEND_API_KEY');
  if ($key === '') {
    error_log("[MedReach mail] to=$to subject=$subject\n$text");
    return true;
  }

  $context = stream_context_create(['http' => [
    'method'        => 'POST',
    'header'        => "Authorization: Bearer $key\r\nContent-Type: application/json\r\n",
    'content'       => json_encode([
      'from'    => mr_env('MAIL_FROM', 'MedReach <onboarding@resend.dev>'),
      'to'      => [$to],
      'subject' => $subject,
      'text'    => $text,
    ]),
    'timeout'       => 10,
    'ignore_errors' => true,
  ]]);
  $body   = @file_get_contents('https://api.resend.com/emails', false, $context);
  $headers = function_exists('http_get_last_response_headers') ? http_get_last_response_headers() : ($http_response_header ?? []);
  $status  = (int) (explode(' ', $headers[0] ?? '')[1] ?? 0);

  if ($status < 200 || $status >= 300) {
    error_log("[MedReach mail] Resend failed ($status) for $to: " . ($body ?: 'no response'));
    return false;
  }
  return true;
}
