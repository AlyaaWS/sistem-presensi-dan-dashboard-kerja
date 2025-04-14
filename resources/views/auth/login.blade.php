<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background-color: #151D4B;
        color: white;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 100px;
        padding-top: 130px;
        padding-left: 120px;
        max-width: 700px;
        position: relative;
        z-index: 0; /* supaya kontennya tetap di atas wave */
    }

    .login-title {
        font-size: 46px;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .form-group {
        width: 145%;
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
    }

    .form-group input[type="email"],
    .form-group input[type="password"],
    .form-group input[type="text"] {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: none;
        background-color: #dcdcdc;
        color: #000;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .checkbox-group input {
        margin-right: 8px;
    }

    .checkbox-group label {
        font-size: 14px;
    }

    .button-group {
        margin-top: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        font-size: 14px;
    }

    .btn-pink {
        background-color: #ff59b8;
        color: white;
        border: none;
        padding: 10px 25px;
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-pink:hover {
        background-color: #ff7dc5;
    }

    span {
        font-size: 14px;
    }

    .user-link {
        position: absolute;
        top: 35px;
        right: 30px;
        z-index: 10;
    }

    .user-link a {
        background-color: #ff59b8;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
    }

    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        padding: 10px;
        background-color: #415dd0;
        font-weight: bold;
    }

    .logo {
        position: absolute;
        top: 0px;
        left: 0px;
        z-index: 20;
    }

    .logo img {
        height: 150px;
        width: auto;
    }

    .error {
        color: #ffbebe;
        font-size: 14px;
        margin-top: 5px;
    }

    .wave-img {
        position: absolute;
        top: -60px;
        right: 10px;
        width: 850px;
        height: 800px;
        z-index: 0;
        pointer-events: none;
    }
</style>

<!-- Tombol ke halaman pengguna -->
<div class="user-link">
    <a href="#">Halaman pengguna</a>
</div>

<!-- Logo pojok kiri atas -->
<div class="logo">
    <img src="{{ asset('logo.png') }}" alt="Logo">
</div>

<!-- Gambar Wave -->
<img src="{{ asset('wave.png') }}" alt="Wave Background" class="wave-img">

<!-- Form Login -->
<div class="container">
    <div class="login-title">Silakan Login Admin,</div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" :value="old('username')" required autocomplete="username" />
            @error('username')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="checkbox-group">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">Ingat password saya</label>
        </div>

        <!-- Tombol -->
        <div class="button-group">
            <button type="submit" class="btn-pink">Login</button>

            <span>Belum punya akun?</span>

            <a href="{{ route('register') }}" class="btn-pink">Register</a>
        </div>
    </form>
</div>

<!-- Footer -->
<div class="footer">@AALYAAS</div>
