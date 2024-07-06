<x-layout>
    <x-slot:heading>
        Authentication
    </x-slot:heading>
    <div class="auth">
        <div class="auth-image">
            <img src="{{ asset('img/auth/auth.jpg') }}" alt="Auth photo">
        </div>
        <div id="auth-content" class="auth-form">
            @include('auth.partials.login')
        </div>
    </div>
</x-layout>
