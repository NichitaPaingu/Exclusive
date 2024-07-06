<div class="header-main">
    <div class="header-main-content">
        <h1>Exclusive</h1>
        <nav>
            <a class="nav-link" data-url="/">Home</a>
            <a class="nav-link" data-url="/contact">Contact</a>
            <a class="nav-link" data-url="/about">About</a>
            @guest
            <a class="nav-link" data-url="/auth">Sign Up</a>
            @endguest
            @auth
            <a class="nav-link" data-url="/dashboard">Dashboard</a>
            @endauth
        </nav>
        <div class="search-and-icons">
            <div class="search-container">
                <input type="text" placeholder="What are you looking for?" class="search-input">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
            </div>
            <nav>
                <a class="nav-link" data-url="/profile/wishlist"><i class="fa-regular fa-heart"></i></a>
                <a class="nav-link" data-url="/profile/cart"><i class="fa-solid fa-cart-shopping"></i></a>
                @auth
                    <div class="profile-menu">
                        <i class="fa-regular fa-user profile-icon"></i>
                        <div class="dropdown-menu">
                            <a class="nav-link" data-url="/dashboard"><i class="fa-regular fa-user"></i> Manage My Account</a>
                            <a class="nav-link" data-url="/orders"><i class="fa-solid fa-box"></i> My Order</a>
                            <a class="nav-link" data-url="/reviews"><i class="fa-solid fa-star"></i> My Reviews</a>
                            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                @csrf
                                <button type="submit" class="logout-button">
                                    <i class="fa-solid fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </nav>
        </div>
    </div>
</div>
