<?php
$title = 'Sign Up — MedReach';
$bodyClass = 'mr-auth-body';
$mr_old = fn (string $key) => htmlspecialchars($_POST[$key] ?? '');
?>
  <div class="mr-auth">
    <div class="mr-auth-card">

      <div class="mr-auth-card__brand">
        <div class="mr-auth-card__brand-text">
          <h2>Join 240+<br>pharmacies and<br>thousands of<br>patients</h2>
        </div>

        <ul class="mr-auth-features">
          <li><img src="presentation/assets/images/icons/filled/ffffff/checkmark.png" alt=""> Fast delivery</li>
          <li><img src="presentation/assets/images/icons/filled/ffffff/checkmark.png" alt=""> Trusted pharmacists</li>
          <li><img src="presentation/assets/images/icons/filled/ffffff/checkmark.png" alt=""> Easy prescription uploads</li>
        </ul>

        <div class="mr-auth-community">
          <div class="mr-auth-community__avatars">
            <img src="presentation/assets/images/avatar-placeholder-1.png" alt="">
            <img src="presentation/assets/images/avatar-placeholder-2.png" alt="">
            <img src="presentation/assets/images/avatar-placeholder-3.png" alt="">
          </div>
          <div>
            <strong>Trusted Community</strong>
            <span>Growing daily</span>
          </div>
        </div>
      </div>

      <div class="mr-auth-card__form">
        <a class="mr-auth__logo" href="index.php">
          <img src="presentation/assets/images/logo.png" alt="MedReach Logo">
        </a>
        <h1>Create your account</h1>

        <?php $mr_tabs_label = 'Sign up as'; require __DIR__ . '/partials/auth-tabs.php'; ?>

        <?php require __DIR__ . '/partials/auth-flash.php'; ?>

        <form class="mr-auth-form mr-auth-form--grid" method="post" action="sign-up.php">
          <input type="hidden" name="csrf" value="<?= mr_csrf_token() ?>">
          <input type="hidden" name="role" value="<?= $mr_role ?>">

          <div class="mr-signup-step" data-step="1">
            <p class="mr-signup-step__label mr-field--span2">Step 1 of 3 · Your details</p>

            <div class="mr-field">
              <label for="first_name">First name</label>
              <div class="mr-field__input">
                <input type="text" id="first_name" name="first_name" placeholder="Nimal" maxlength="50" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" autocomplete="given-name" required>
              </div>
            </div>

            <div class="mr-field">
              <label for="last_name">Last name</label>
              <div class="mr-field__input">
                <input type="text" id="last_name" name="last_name" placeholder="Perera" maxlength="50" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" autocomplete="family-name" required>
              </div>
            </div>

            <div class="mr-field mr-field--span2">
              <label for="email">Email address</label>
              <div class="mr-field__input">
                <input type="email" id="email" name="email" placeholder="nimal.perera@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" autocomplete="email" required>
              </div>
            </div>

            <div class="mr-field mr-field--span2">
              <label for="phone">Phone number</label>
              <div class="mr-field__input">
                <input type="tel" id="phone" name="phone" placeholder="071 234 5678" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" autocomplete="tel" required>
              </div>
            </div>

            <div class="mr-signup-step__nav mr-field--span2">
              <button type="button" class="mr-btn mr-btn--primary" data-step-next>Continue</button>
            </div>
          </div>

          <div class="mr-signup-step" data-step="2">
            <p class="mr-signup-step__label mr-field--span2">Step 2 of 3 · <?php foreach (['patient' => 'Personal details', 'pharmacist' => 'Pharmacy details', 'delivery' => 'Rider details'] as $key => $label): ?><span data-role-fields="<?= $key ?>"<?= $key === $mr_role ? '' : ' hidden' ?>><?= $label ?></span><?php endforeach; ?></p>

            <fieldset class="mr-role-fields" data-role-fields="patient"<?= $mr_role === 'patient' ? '' : ' hidden disabled' ?>>
              <div class="mr-field">
                <label for="date_of_birth">Date of birth <span class="mr-field__optional">(optional)</span></label>
                <div class="mr-field__input">
                  <input type="date" id="date_of_birth" name="date_of_birth" max="<?= date('Y-m-d') ?>" value="<?= $mr_old('date_of_birth') ?>" autocomplete="bday">
                </div>
              </div>

              <div class="mr-field mr-field--span2">
                <label for="address">Delivery address <span class="mr-field__optional">(optional)</span></label>
                <div class="mr-field__input">
                  <input type="text" id="address" name="address" placeholder="12 Galle Road, Colombo 03" maxlength="255" value="<?= $mr_old('address') ?>" autocomplete="street-address">
                </div>
              </div>

              <label class="mr-auth-terms mr-field--span2">
                <input type="checkbox" name="is_guardian" value="1"<?= empty($_POST['is_guardian']) ? '' : ' checked' ?>>
                I'm a guardian and will also manage family members' prescriptions.
              </label>
            </fieldset>

            <fieldset class="mr-role-fields" data-role-fields="pharmacist"<?= $mr_role === 'pharmacist' ? '' : ' hidden disabled' ?>>
              <div class="mr-field">
                <label for="pharmacy_name">Pharmacy name</label>
                <div class="mr-field__input">
                  <input type="text" id="pharmacy_name" name="pharmacy_name" placeholder="Apex Care Pharmacy" maxlength="100" value="<?= $mr_old('pharmacy_name') ?>" autocomplete="organization" required>
                </div>
              </div>

              <div class="mr-field">
                <label for="licence_no">NMRA licence no.</label>
                <div class="mr-field__input">
                  <input type="text" id="licence_no" name="licence_no" placeholder="PH-2026-0418" maxlength="30" value="<?= $mr_old('licence_no') ?>" required>
                </div>
              </div>

              <div class="mr-field mr-field--span2">
                <label for="pharmacy_address">Address</label>
                <div class="mr-field__input">
                  <input type="text" id="pharmacy_address" name="pharmacy_address" placeholder="45 Ward Place" maxlength="255" value="<?= $mr_old('pharmacy_address') ?>" required>
                </div>
              </div>

              <div class="mr-field">
                <label for="city">City</label>
                <div class="mr-field__input">
                  <input type="text" id="city" name="city" placeholder="Colombo 07" maxlength="50" value="<?= $mr_old('city') ?>" required>
                </div>
              </div>

              <div class="mr-field">
                <label for="operating_hours">Opening hours <span class="mr-field__optional">(optional)</span></label>
                <div class="mr-field__input">
                  <input type="text" id="operating_hours" name="operating_hours" placeholder="8 AM – 10 PM" maxlength="100" value="<?= $mr_old('operating_hours') ?>">
                </div>
              </div>
            </fieldset>

            <fieldset class="mr-role-fields" data-role-fields="delivery"<?= $mr_role === 'delivery' ? '' : ' hidden disabled' ?>>
              <div class="mr-field mr-field--span2">
                <label for="nic_no">NIC number</label>
                <div class="mr-field__input">
                  <input type="text" id="nic_no" name="nic_no" placeholder="199512345678" maxlength="12" value="<?= $mr_old('nic_no') ?>" required>
                </div>
              </div>

              <div class="mr-field">
                <label for="vehicle_type">Vehicle type</label>
                <div class="mr-field__input">
                  <select id="vehicle_type" name="vehicle_type" required>
                    <option value="">Choose…</option>
                    <?php foreach (MR_VEHICLE_TYPES as $key => $label): ?>
                      <option value="<?= $key ?>"<?= ($_POST['vehicle_type'] ?? '') === $key ? ' selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="mr-field">
                <label for="vehicle_number">Vehicle number</label>
                <div class="mr-field__input">
                  <input type="text" id="vehicle_number" name="vehicle_number" placeholder="WP BAB-1234" maxlength="15" value="<?= $mr_old('vehicle_number') ?>" required>
                </div>
              </div>
            </fieldset>

            <p class="mr-auth-approval mr-field--span2" data-role-fields="pharmacist delivery"<?= $mr_role === 'patient' ? ' hidden' : '' ?>>
              An admin reviews new pharmacy and delivery accounts before you can sign in.
            </p>

            <div class="mr-signup-step__nav mr-field--span2">
              <button type="button" class="mr-btn mr-btn--ghost" data-step-back>Back</button>
              <button type="button" class="mr-btn mr-btn--primary" data-step-next>Continue</button>
            </div>
          </div>

          <div class="mr-signup-step" data-step="3">
            <p class="mr-signup-step__label mr-field--span2">Step 3 of 3 · Password</p>

            <div class="mr-field">
              <label for="password">Password</label>
              <div class="mr-field__input">
                <input type="password" id="password" name="password" placeholder="••••••••" minlength="8" maxlength="72" autocomplete="new-password" required>
              </div>
            </div>

            <div class="mr-field">
              <label for="confirm_password">Confirm password</label>
              <div class="mr-field__input">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" minlength="8" maxlength="72" autocomplete="new-password" required>
              </div>
            </div>

            <label class="mr-auth-terms mr-field--span2">
              <input type="checkbox" name="agree_terms" required>
              I agree to the <a class="mr-link" href="policies.php#terms" target="_blank">Terms of Service</a> and <a class="mr-link" href="policies.php#privacy" target="_blank">Privacy Policy</a>.
            </label>

            <div class="mr-signup-step__nav mr-field--span2">
              <button type="button" class="mr-btn mr-btn--ghost" data-step-back>Back</button>
              <button type="submit" class="mr-btn mr-btn--primary mr-auth-form__submit">Create account</button>
            </div>
          </div>
        </form>

        <p class="mr-auth__footer-text">Already registered? <a class="mr-link mr-link--strong" href="sign-in.php">Sign in</a></p>
      </div>

    </div>
  </div>
