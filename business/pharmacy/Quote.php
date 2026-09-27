<?php
require_once __DIR__ . '/../../data/pharmacy/QuoteData.php';

function mr_page_pharmacy_dashboard(): ?array
{
  return mr_form('mr_handle_dashboard_quote');
}

function mr_page_prescription_request(): ?array
{
  $id = (int) ($_GET['id'] ?? 0);
  if (!mr_prescription_detail($id)) {
    mr_error_page(404);
  }
  return mr_form('mr_handle_prescription_request');
}

function mr_pharmacy_requests(): array
{
  $pharmacyId = mr_pharmacy_id_for_user((int) $_SESSION['user_id']);
  if (!$pharmacyId) {
    return [];
  }
  return array_map(fn (array $r) => $r + [
    'is_quoted'         => $r['quote_status'] === 'quoted',
    'quoted_total_fmt'  => $r['quote_status'] === 'quoted' ? number_format((float) $r['quoted_total'], 2) : null,
  ], mr_pending_prescriptions($pharmacyId));
}

function mr_prescription_detail(int $prescriptionId): ?array
{
  $pharmacyId = mr_pharmacy_id_for_user((int) $_SESSION['user_id']);
  if (!$pharmacyId) {
    return null;
  }
  $row = mr_prescription_for_pharmacy($prescriptionId, $pharmacyId);
  if (!$row) {
    return null;
  }
  return $row + [
    'is_quoted'        => $row['quote_status'] === 'quoted',
    'quoted_total_fmt' => $row['quote_status'] === 'quoted' ? number_format((float) $row['quoted_total'], 2) : null,
  ];
}

function mr_quote_input(array $in): array
{
  $items = trim($in['quoted_items'] ?? '');
  $total = trim($in['quoted_total'] ?? '');
  $error = match (true) {
    $items === ''                                  => 'Enter the medicines you are quoting.',
    mb_strlen($items) > 2000                        => 'The quote is too long (2000 characters max).',
    !preg_match('/^\d{1,7}(\.\d{1,2})?$/', $total)  => 'Enter a valid total, e.g. 1250.50.',
    (float) $total <= 0                             => 'The total must be greater than 0.',
    (float) $total > 1000000                        => 'The total can be at most LKR 1,000,000.',
    default                                          => null,
  };
  return [$error, $items, (float) $total];
}

function mr_handle_dashboard_quote(array $in): ?array
{
  $pharmacyId = mr_pharmacy_id_for_user((int) $_SESSION['user_id']);
  if (!$pharmacyId) {
    return mr_error('Your account is not linked to a pharmacy.');
  }
  if (($in['action'] ?? '') !== 'withdraw') {
    return mr_error('Unknown action.');
  }
  $prescriptionId = (int) ($in['prescription_id'] ?? 0);
  $quote = mr_prescription_for_pharmacy($prescriptionId, $pharmacyId);
  if (!$quote || $quote['quote_status'] !== 'quoted') {
    return mr_error('That quote no longer exists.');
  }
  mr_quote_withdraw($prescriptionId, $pharmacyId);
  mr_flash('success', 'Quote withdrawn.');
  mr_redirect('pharmacy-dashboard.php');
}

function mr_handle_prescription_request(array $in): ?array
{
  $prescriptionId = (int) ($in['prescription_id'] ?? 0);
  $pharmacyId = mr_pharmacy_id_for_user((int) $_SESSION['user_id']);
  if (!$pharmacyId) {
    return mr_error('Your account is not linked to a pharmacy.');
  }

  $existing = mr_prescription_for_pharmacy($prescriptionId, $pharmacyId);
  if (!$existing) {
    return mr_error('This request is no longer available.');
  }

  $action = $in['action'] ?? '';
  $redirect = fn () => mr_redirect('prescription-request.php?id=' . $prescriptionId);

  if ($action === 'withdraw') {
    if ($existing['quote_status'] !== 'quoted') {
      return mr_error('That quote no longer exists.');
    }
    mr_quote_withdraw($prescriptionId, $pharmacyId);
    mr_flash('success', 'Quote withdrawn.');
    $redirect();
  }

  if ($action === 'send') {
    if ($existing['quote_status'] === 'quoted') {
      return mr_error('You already sent a quote for this request. Edit it instead.') + ['modal' => 'mr-quote-create-form'];
    }
    [$error, $items, $total] = mr_quote_input($in);
    if ($error) {
      return mr_error($error) + ['modal' => 'mr-quote-create-form'];
    }
    mr_quote_create($prescriptionId, $pharmacyId, $items, $total);
    mr_flash('success', 'Quote sent.');
    $redirect();
  }

  if ($action === 'update') {
    if ($existing['quote_status'] !== 'quoted') {
      return mr_error('Send a quote before you can edit it.') + ['modal' => 'mr-quote-edit-modal'];
    }
    [$error, $items, $total] = mr_quote_input($in);
    if ($error) {
      return mr_error($error) + ['modal' => 'mr-quote-edit-modal'];
    }
    mr_quote_update($prescriptionId, $pharmacyId, $items, $total);
    mr_flash('success', 'Quote updated.');
    $redirect();
  }

  return mr_error('Unknown action.');
}
