<?php foreach ([
  'first_name' => ['First name', 'text', 'given-name', 'Nimal'],
  'last_name'  => ['Last name', 'text', 'family-name', 'Perera'],
  'email'      => ['Email', 'email', 'email', 'nimal@example.com'],
  'phone'      => ['Phone', 'tel', 'tel', '071 234 5678'],
] as $mr_name => [$mr_label, $mr_type, $mr_auto, $mr_hint]): ?>
<div class="mr-field">
  <label for="<?= "$mr_prefix-$mr_name" ?>"><?= $mr_label ?></label>
  <div class="mr-field__input">
    <input type="<?= $mr_type ?>" id="<?= "$mr_prefix-$mr_name" ?>" name="<?= $mr_name ?>" placeholder="<?= $mr_hint ?>" value="<?= $mr_old($mr_name) ?>" autocomplete="<?= $mr_auto ?>"<?= $mr_type === 'text' ? ' maxlength="50" pattern="' . htmlspecialchars(MR_NAME_PATTERN) . '" title="Use letters only."' : ($mr_type === 'email' ? ' maxlength="255"' : '') ?> required>
  </div>
</div>
<?php endforeach; ?>
