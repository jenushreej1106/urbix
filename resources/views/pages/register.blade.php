@extends('layouts.app')

@section('title', 'Create Account')

@section('content')

<style>
.auth-wrapper {
    min-height: 90vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 60px 20px;
    background: radial-gradient(circle at top, #172b4d, #080b16 65%);
}

.auth-card {
    width: 100%;
    max-width: 480px;
    padding: 40px;
    background: rgba(17, 24, 39, .95);
    border: 1px solid #263653;
    border-radius: 20px;
    box-shadow: 0 0 40px rgba(0,212,255,.08);
}

.auth-title {
    font-family: 'Orbitron', sans-serif;
    text-align: center;
    font-size: 27px;
    color: #00d4ff;
    margin-bottom: 10px;
}

.auth-subtitle {
    text-align: center;
    color: #8994aa;
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    color: #dce4f2;
    margin-bottom: 9px;
    font-size: 13px;
}

.form-group input {
    width: 100%;
    padding: 14px;
    background: #080f1d;
    border: 1px solid #344766;
    border-radius: 9px;
    color: white;
    outline: none;
    box-sizing: border-box;
}

.form-group input:focus {
    border-color: #00d4ff;
    box-shadow: 0 0 12px rgba(0,212,255,.15);
}

.auth-btn {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 9px;
    background: linear-gradient(90deg, #007cf0, #00d4ff);
    color: white;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: .3s;
}

.auth-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 0 25px rgba(0,212,255,.35);
}

.auth-footer {
    text-align: center;
    color: #8994aa;
    margin-top: 25px;
    font-size: 13px;
}

.auth-footer a {
    color: #00d4ff;
    text-decoration: none;
    font-weight: 600;
}

.error-message {
    color: #ff8197;
    font-size: 12px;
    margin-top: 7px;
}

.error-box {
    background: #4b202b;
    color: #ffb2c0;
    padding: 13px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 13px;
}

@media(max-width: 500px) {
    .auth-card {
        padding: 25px;
    }
}
</style>

<div class="auth-wrapper">

    <div class="auth-card">

        <h1 class="auth-title">JOIN URBIX</h1>

        <p class="auth-subtitle">
            Create your citizen account
        </p>

        @if($errors->any())
            <div class="error-box">
                <strong>Please correct the following:</strong>

                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">

            @csrf

            <div class="form-group">
                <label>Full Name</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your full name"
                    required
                    autocomplete="name">

                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email Address</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                    autocomplete="email">

                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Minimum 8 characters"
                    required
                    autocomplete="new-password">

                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Confirm Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Re-enter your password"
                    required
                    autocomplete="new-password">
            </div>

            <button type="submit" class="auth-btn">
                CREATE ACCOUNT →
            </button>

        </form>

        <div class="auth-footer">
            Already have an account?

            <a href="{{ route('login') }}">Login</a>
        </div>

    </div>

</div>

@endsection