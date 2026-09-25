<?php
// MedReach - Auth page message (presentation tier: HTML output only)
// Expects $flash = ['type' => 'error'|'success', 'text' => '...'] or null.
if (empty($flash)) return;
$mr_is_error = $flash['type'] === 'error';
?>
<div class="mr-auth-notice<?= $mr_is_error ? ' mr-auth-notice--error' : '' ?>" role="<?= $mr_is_error ? 'alert' : 'status' ?>">
  <img src="https://img.icons8.com/ios-filled/50/<?= $mr_is_error ? 'd6534a/error' : '1f9d6b/checkmark' ?>.png" alt="">
  <span><?= htmlspecialchars($flash['text']) ?></span>
</div>
