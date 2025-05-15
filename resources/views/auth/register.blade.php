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

    .register-title {
        font-size: 46px;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .form-group {
        width: 215%;
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
        font-size: 10px;
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

    .btn-register {
    background-color: #ff59b8;
    color: white;
    border: none;
    padding: 10px 25px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    margin-left: 20px;
    }

    .link-register {
        color: #ff59b8;
        text-decoration: none;
        font-size: 14px;
    }

    .link-register:hover {
        color: white;
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

<!-- Form Register -->
<div class="container">
    <div class="register-title">Silakan Register,</div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        
        <a class="link-register" href="{{ route('login') }}">
            {{ __('Sudah register?') }}
        </a>               

            <button type="submit" class="btn-register">
                {{ __('Register') }}
            </button>
            
        </div>
    </form>
</div>

<!-- Footer -->
<div class="footer">@AALYAAS</div>

