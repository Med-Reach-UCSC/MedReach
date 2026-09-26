<div class="mr-avatar-upload" data-avatar-upload>
  <span class="mr-avatar mr-avatar--profile">
    <span data-avatar-initials><?= $initials ?></span>
    <img data-avatar-photo alt="Profile photo" hidden>
  </span>
  <button type="button" class="mr-avatar-upload__btn" aria-label="Change profile photo">
    <img src="presentation/assets/images/icons/filled/ffffff/camera.png" alt="">
  </button>
  <input type="file" accept="image/png,image/jpeg" data-max-mb="2" hidden>
  <button type="button" class="mr-link mr-avatar-upload__remove" data-avatar-remove data-confirm="Remove your profile photo?" data-confirm-text="Your initials will show instead." data-confirm-label="Remove photo" hidden>Remove photo</button>
</div>
