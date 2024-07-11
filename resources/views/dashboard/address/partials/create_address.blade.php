<form id="create-address-form" action="{{ route('profile.address.store') }}" method="POST">
    @csrf
    <h2>Create Your Address</h2>
    <div class="form-group">
        <label for="street">Street</label>
        <input type="text" id="street" name="street" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" name="city" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="state">State</label>
        <input type="text" id="state" name="state" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="postal_code">Postal Code</label>
        <input type="text" id="postal_code" name="postal_code" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" id="country" name="country" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Address</button>
    <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>
</form>
