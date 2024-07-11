<form id="edit-payment-form-{{ $paymentMethod->id }}" action="{{ route('profile.payment.update', ['id' => $paymentMethod->id]) }}" method="POST">
    @csrf
    <h2>Edit Your Payment Options</h2>
    <div class="form-group">
        <label for="card_number">Card Number</label>
        <input type="text" id="card_number" name="card_number" class="form-control" value="{{ implode(' ', str_split(old('card_number', $paymentMethod->card_number), 4)) }}" required>
    </div>
    <div class="form-group">
        <label for="expiry_date">Expiry Date</label>
        <input type="text" id="expiry_date" name="expiry_date" class="form-control" value="{{ substr(old('expiry_date', $paymentMethod->expiry_date), 0, 2) . '/' . substr(old('expiry_date', $paymentMethod->expiry_date), 2) }}" required>
    </div>
    <div class="form-group">
        <label for="cvv">CVV</label>
        <input type="text" id="cvv" name="cvv" class="form-control" value="{{ old('cvv', $paymentMethod->cvv) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
    <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>
    <button type="button" class="btn btn-danger btn-delete" data-id="{{ $paymentMethod->id }}">Delete</button>
</form>
