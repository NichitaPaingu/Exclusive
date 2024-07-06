<div class="profile-section">
    <h2>Address Book</h2>
    @if(Auth::user()->address)
        <p>Street: {{ Auth::user()->address->street }}</p>
        <p>City: {{ Auth::user()->address->city }}</p>
        <p>State: {{ Auth::user()->address->state }}</p>
        <p>Postal Code: {{ Auth::user()->address->postal_code }}</p>
        <p>Country: {{ Auth::user()->address->country }}</p>
        <a href="#" class="profile-link" data-url="/profile/address/edit">Edit Address</a>
    @else
        <p>No address available.</p>
        <a href="#" class="profile-link" data-url="/profile/address/create">Add Address</a>
    @endif
</div>
<div id="profile-content"></div>
