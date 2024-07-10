<h2>Create an account</h2>
<p>Enter your details below</p>
<form id="register-form" action="/api/register" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" name="first_name" placeholder="First Name" required>
    </div>
    <div class="form-group">
        <input type="text" name="last_name" placeholder="Last Name" required>
    </div>
    <div class="form-group">
        <input type="email" name="email" placeholder="Email" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn-create-account">Create Account</button>
    <a class="login-link">
        <button type="button" class="btn-login">
            Already have account? Log in
        </button>
    </a>
</form>
