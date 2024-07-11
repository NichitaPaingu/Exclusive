<div class="profile-section">
    <h2>My Payment Options</h2>
    @foreach($paymentMethods as $paymentMethod)
        <div class="payment-method">
            <p>Card Number: {{ implode(' ', str_split($paymentMethod->card_number, 4)) }}</p>
            <p>Expiry Date: {{ substr($paymentMethod->expiry_date, 0, 2) . '/' . substr($paymentMethod->expiry_date, 2) }}</p>
            <p>CVV: {{ $paymentMethod->cvv }}</p>
            <a href="#" class="profile-link" data-url="/profile/payment/edit/{{ $paymentMethod->id }}">Edit Payment Options</a>
        </div>
    @endforeach
    <a href="#" class="profile-link" data-url="/profile/payment/create">Add Payment Options</a>
</div>
