<form id="edit-address-form" action="{{ route('profile.address.update') }}" method="POST">
    @csrf
    <h2>Edit Your Address</h2>
    <div class="form-group">
        <label for="street">Street</label>
        <input type="text" id="street" name="street" class="form-control" value="{{ old('street', $address->street) }}" required>
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $address->city) }}" required>
    </div>
    <div class="form-group">
        <label for="state">State</label>
        <input type="text" id="state" name="state" class="form-control" value="{{ old('state', $address->state) }}" required>
    </div>
    <div class="form-group">
        <label for="postal_code">Postal Code</label>
        <input type="text" id="postal_code" name="postal_code" class="form-control" value="{{ old('postal_code', $address->postal_code) }}" required>
    </div>
    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" id="country" name="country" class="form-control" value="{{ old('country', $address->country) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
    <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>
</form>
