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
