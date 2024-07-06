<form id="edit-profile-form" action="{{ route('profile.update') }}" method="POST">
    @csrf
    <h2>Edit Your Profile</h2>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', Auth::user()->first_name) }}" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', Auth::user()->last_name) }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
    </div>
    <h3>Password Changes</h3>
    <div class="form-group">
        <label for="current_password">Current Password</label>
        <input type="password" id="current_password" name="current_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" id="new_password" name="new_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirm New Password</label>
        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
    <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>
</form>
