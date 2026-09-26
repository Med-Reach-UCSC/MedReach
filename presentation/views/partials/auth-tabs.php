<?php
$mr_role = isset(MR_PUBLIC_ROLES[$_POST['role'] ?? '']) ? $_POST['role'] : 'patient';
?>
<div class="mr-auth-tabs" role="tablist" aria-label="<?= htmlspecialchars($mr_tabs_label) ?>">
  <?php foreach (MR_PUBLIC_ROLES as $key => $label): ?>
    <button type="button" class="mr-auth-tabs__btn<?= $key === $mr_role ? ' is-active' : '' ?>" role="tab" aria-selected="<?= $key === $mr_role ? 'true' : 'false' ?>" data-role="<?= $key ?>"><?= htmlspecialchars($label) ?></button>
  <?php endforeach; ?>
</div>
