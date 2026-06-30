@extends('layouts.guest')
@section('content')
<div class="login-page">
    <div class="login-card">
        <h1 class="login-title">Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="login-group">
                <label>Email atau Username</label>
                <input type="text" name="login" value="{{ old('login') }}" placeholder="Masukkan email atau username" required>
                @error('login')
                    <small class="login-error">{{ $message }}</small>
                @enderror
            </div>
            <div class="login-group">
                <label>Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
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
            <button type="submit" class="login-button">Masuk Dashboard</button>
        </form>
    </div>
</div>

<script>
function togglePassword()
{
    const password =
        document.getElementById('password');

    const icon =
        document.getElementById('passwordIcon');

    if(password.type === 'password')
    {
        password.type = 'text';

        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
    else
    {
        password.type = 'password';

        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>
@endsection