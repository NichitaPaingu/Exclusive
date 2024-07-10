<h2>Log in to Exclusive</h2>
<p>Enter your details below</p>
<form id="login-form" action="/api/login" method="POST">
    @csrf
    <div class="form-group">
        <input type="email" name="email" placeholder="Email" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" placeholder="Password" required>
    </div>
    <div class="remember-me">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember Me</label>
    </div>
    <div class="login-section">
        <button type="submit" class="btn-log-in">Log in</button>
        <div class="forget-password">
            <a href="">Forget Password?</a>
        </div>
    </div>
    <a class="register-link">
        <button type="button" class="btn-login">
            Do not have account? Sign up
        </button>
    </a>
</form>
