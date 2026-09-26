<section class="mr-card mr-dash-card">
  <div class="mr-dash-card__head">
    <h2>Change Password</h2>
  </div>

  <form class="mr-auth-form" data-toast="Password updated.">
    <?php foreach (['Current Password' => 'Enter current password', 'New Password' => 'Enter new password', 'Confirm New Password' => 'Re-enter new password'] as $mr_label => $mr_hint): ?>
    <label class="mr-field">
      <span><?= $mr_label ?></span>
      <div class="mr-field__input">
        <img class="mr-field__icon" src="presentation/assets/images/icons/filled/757687/lock--v1.png" alt="">
        <input type="password" placeholder="<?= $mr_hint ?>" required>
      </div>
    </label>
    <?php endforeach; ?>
    <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Update Password</button>
  </form>
</section>
