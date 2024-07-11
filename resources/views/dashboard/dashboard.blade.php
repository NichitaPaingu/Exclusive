<x-layout>
    <x-slot:heading>
        Dashboard
    </x-slot:heading>
    <div class="topik">
        <x-breadcrumbs />
        <h2>Welcome! <span>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span></h2>
    </div>
    <div class="main">
        <div class="dashboard">
            <aside class="sidebar">
                <h3>Manage My Account</h3>
                <ul>
                    <li><a class="profile-link" data-url="/profile/info">My Profile</a></li>
                    <li><a class="profile-link" data-url="/profile/address">Address Book</a></li>
                    <li><a class="profile-link" data-url="/profile/payment">My Payment Options</a></li>
                </ul>
                <h3>My Orders</h3>
                <ul>
                    <li><a class="profile-link" data-url="/profile/returns">My Returns</a></li>
                    <li><a class="profile-link" data-url="/profile/cancellations">My Cancellations</a></li>
                </ul>
            </aside>
            <div class="profile-content" id="profile-content">
                <!-- Dynamic content will be loaded here -->
            </div>
        </div>
    </div>
</x-layout>
