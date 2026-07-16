@extends('layouts.guest')

@section('content')
<div class="login-page">
    <main class="login-container">
        <div class="login-brand">
            <img src="{{ asset('images/logo-boxplay.png') }}" alt="BoxPlay.id">
        </div>

        <div class="login-card">
            <div class="login-header">
                <h1>Login</h1>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="login-group">
                    <label for="login">Email atau Username</label>
                    <input id="login" type="text" name="login" value="{{ old('login') }}"
                        placeholder="Masukkan email atau username" autocomplete="username" required autofocus>
                    @error('login')
                        <small class="login-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="login-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input id="password" type="password" name="password"
                            placeholder="Masukkan password" autocomplete="current-password" required>
                        <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Tampilkan password">
                            <i id="passwordIcon" class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <small class="login-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="login-options">
                    <label class="remember-box">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="login-button">Masuk</button>
            </form>
        </div>
    </main>
</div>

<script>
function togglePassword(){
    const password=document.getElementById('password');
    const icon=document.getElementById('passwordIcon');
    const isHidden=password.type==='password';

    password.type=isHidden?'text':'password';
    icon.classList.toggle('bi-eye',!isHidden);
    icon.classList.toggle('bi-eye-slash',isHidden);
}
</script>
@endsection