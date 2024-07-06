<div class="profile-section">
    <h2>My Profile</h2>
    <p>First Name: {{ Auth::user()->first_name }}</p>
    <p>Last Name: {{ Auth::user()->last_name }}</p>
    <p>Email: {{ Auth::user()->email }}</p>
    <a href="#" class="btn-edit" data-url="/profile/edit">Edit Profile</a>
</div>
