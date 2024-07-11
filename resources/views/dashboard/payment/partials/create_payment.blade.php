<form id="create-payment-form" action="{{ route('profile.payment.store') }}" method="POST">
    @csrf
    <h2>Create Your Payment Option</h2>
    <div class="form-group">
        <label for="card_number">Card Number</label>
        <input type="text" id="card_number" name="card_number" class="form-control" maxlength="19" required>
    </div>
    <div class="form-group">
        <label for="expiry_date">Expiry Date</label>
        <input type="text" id="expiry_date" name="expiry_date" class="form-control" maxlength="5" required>
    </div>
    <div class="form-group">
        <label for="cvv">CVV</label>
        <input type="text" id="cvv" name="cvv" class="form-control" maxlength="3" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Payment Option</button>
    <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>
</form>
