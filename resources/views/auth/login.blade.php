<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login | SIMRAP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {

            min-height: 100vh;

            background:
                linear-gradient(
                    135deg,
                    #EAF8F5 0%,
                    #F5F7FB 50%,
                    #DFF7F3 100%
                );

            font-family: 'Segoe UI', sans-serif;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 20px;

        }

        .login-wrapper {

            width: 100%;

            max-width: 1000px;

            min-height: 580px;

            background: white;

            border-radius: 25px;

            overflow: hidden;

            box-shadow:
                0 15px 40px rgba(0,0,0,.12);

            display: flex;

        }

        /* =========================
                BAGIAN KIRI
        ========================= */

        .login-info {

            width: 48%;

            background:
                linear-gradient(
                    160deg,
                    #0E5F59,
                    #11786F,
                    #1CB5A3
                );

            color: white;

            display: flex;

            align-items: center;

            justify-content: center;

            text-align: center;

            padding: 50px 40px;

        }

        .login-info-content {

            width: 100%;

        }

        .login-info img {

            width: 95px;

            margin-bottom: 25px;

        }

        .login-info h1 {

            font-size: 48px;

            font-weight: 800;

            letter-spacing: 2px;

            margin-bottom: 12px;

        }

        .login-info h5 {

            font-size: 18px;

            font-weight: 600;

            margin-bottom: 15px;

            line-height: 28px;

        }

        .login-info p {

            font-size: 14px;

            line-height: 24px;

            color: rgba(255,255,255,.88);

            margin-bottom: 0;

        }

        .divider {

            width: 70px;

            height: 3px;

            background: #FFD54F;

            margin: 20px auto;

            border-radius: 5px;

        }

        /* =========================
                BAGIAN KANAN
        ========================= */

        .login-form {

            width: 52%;

            padding: 55px 60px;

            display: flex;

            align-items: center;

        }

        .form-container {

            width: 100%;

            max-width: 420px;

            margin: auto;

        }

        .form-container h2 {

            color: #115E59;

            font-size: 32px;

            font-weight: 700;

            margin-bottom: 8px;

        }

        .form-subtitle {

            color: #777;

            font-size: 14px;

            margin-bottom: 30px;

        }

        .form-label {

            font-weight: 600;

            color: #333;

            margin-bottom: 8px;

        }

        .input-group-custom {

            position: relative;

            margin-bottom: 20px;

        }

        .input-group-custom i {

            position: absolute;

            left: 15px;

            top: 50%;

            transform: translateY(-50%);

            color: #0F766E;

            font-size: 18px;

            z-index: 5;

        }

        .form-control {

            height: 50px;

            border: 1px solid #D8E5E2;

            border-radius: 10px;

            padding-left: 45px;

            font-size: 14px;

        }

        .form-control:focus {

            border-color: #0F766E;

            box-shadow:
                0 0 0 .2rem rgba(15,118,110,.12);

        }

        .remember {

            display: flex;

            align-items: center;

            gap: 8px;

            margin-bottom: 25px;

        }

        .remember input {

            width: 16px;

            height: 16px;

            accent-color: #0F766E;

        }

        .remember label {

            color: #666;

            font-size: 14px;

        }

        .btn-login {

            width: 100%;

            height: 50px;

            border: none;

            border-radius: 10px;

            background:
                linear-gradient(
                    90deg,
                    #0F766E,
                    #16B4A4
                );

            color: white;

            font-size: 16px;

            font-weight: 700;

            transition: .25s;

        }

        .btn-login:hover {

            background: #115E59;

            transform: translateY(-1px);

        }

        .forgot-password {

            display: block;

            text-align: right;

            margin-top: 15px;

            color: #0F766E;

            text-decoration: none;

            font-size: 13px;

        }

        .forgot-password:hover {

            text-decoration: underline;

        }

        .alert-danger {

            border-radius: 10px;

            font-size: 13px;

        }

        .copyright {

            text-align: center;

            margin-top: 30px;

            color: #999;

            font-size: 12px;

        }

        /* =========================
                RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            .login-wrapper {

                flex-direction: column;

                max-width: 500px;

            }

            .login-info {

                width: 100%;

                min-height: 300px;

                padding: 35px 25px;

            }

            .login-info h1 {

                font-size: 40px;

            }

            .login-form {

                width: 100%;

                padding: 40px 30px;

            }

        }

    </style>

</head>

<body>


<div class="login-wrapper">


    <!-- =========================
            INFORMASI SIMRAP
    ========================== -->

    <div class="login-info">

        <div class="login-info-content">

            <img src="{{ asset('images/logo-sumut.png') }}"
                 alt="Logo Sumatera Utara">

            <h1>SIMRAP</h1>

            <div class="divider"></div>

            <h5>
                Sistem Informasi Manajemen Rapat
            </h5>

            <p>

                Dinas Komunikasi dan Informatika
                <br>
                Provinsi Sumatera Utara

            </p>

        </div>

    </div>


    <!-- =========================
            FORM LOGIN
    ========================== -->

    <div class="login-form">

        <div class="form-container">

            <h2>
                Selamat Datang
            </h2>

            <p class="form-subtitle">

                Silakan masuk untuk melanjutkan ke SIMRAP.

            </p>


            <!-- Pesan Session -->

            @if (session('status'))

                <div class="alert alert-success">

                    {{ session('status') }}

                </div>

            @endif


            <!-- Error -->

            @if ($errors->any())

                <div class="alert alert-danger">

                    <i class="bi bi-exclamation-circle"></i>

                    Email atau password yang Anda masukkan
                    tidak sesuai.

                </div>

            @endif


            <form method="POST"
                  action="{{ route('login') }}">

                @csrf


                <!-- Email -->

                <label for="email"
                       class="form-label">

                    Email

                </label>

                <div class="input-group-custom">

                    <i class="bi bi-envelope"></i>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        required
                        autofocus
                        autocomplete="username">

                </div>


                <!-- Password -->

                <label for="password"
                       class="form-label">

                    Password

                </label>

                <div class="input-group-custom">

                    <i class="bi bi-lock"></i>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required
                        autocomplete="current-password">

                </div>


                <!-- Remember -->

                <div class="remember">

                    <input
                        id="remember"
                        type="checkbox"
                        name="remember">

                    <label for="remember">

                        Ingat saya

                    </label>

                </div>


                <!-- Login -->

                <button
                    type="submit"
                    class="btn-login">

                    <i class="bi bi-box-arrow-in-right"></i>

                    Masuk

                </button>


                <!-- Forgot Password -->

                @if (Route::has('password.request'))

                    <a
                        href="{{ route('password.request') }}"
                        class="forgot-password">

                        Lupa password?

                    </a>

                @endif

            </form>


            <div class="copyright">

                © {{ date('Y') }} SIMRAP —
                Diskominfo Provinsi Sumatera Utara

            </div>

        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>