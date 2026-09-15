<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    >
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;

            background-image:
                linear-gradient(
                    rgba(0, 0, 0, 0.25),
                    rgba(0, 0, 0, 0.25)
                ),
                url('{{ asset('images/background.png') }}');

            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;

            overflow-x: hidden;
        }

        .login-wrapper {
            min-height: 100vh;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px 15px;
        }

        .login-card {
            width: 100%;
            max-width: 500px;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <div class="login-card">

            <!-- LOGO -->
            <div class="text-center">

                <img
                    src="{{ asset('images/logo.png') }}"
                    class="logo"
                    alt="REGISTRA Logo"
                >

                <h1 class="title">
                    REGISTRA
                </h1>

                <p class="subtitle">
                    Barangay San Bartolome<br>
                    Sta. Magdalena, Sorsogon
                </p>

            </div>


            <!-- LOGIN FORM -->
            <form method="POST" action="{{ route('login') }}">

                @csrf

                <!-- USERNAME -->
                <div class="mb-3">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        id="username"
                        class="form-control"
                        placeholder="Enter Username"
                        value="{{ old('username') }}"
                        required
                        autofocus
                    >

                    @error('username')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <div class="mb-4">
                    <label for="password">
                        Password
                    </label>
                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Enter Password"
                            required
                        >
                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            onclick="togglePassword()"
                        >
                            <i
                                class="fa-solid fa-eye"
                                id="eye"
                            ></i>
                        </button>

                    </div>

                    @error('password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <button
                    type="submit"
                    class="btn login-btn w-100"
                >
                    <i class="fa-solid fa-right-to-bracket me-2"></i>
                    Login
                </button>

            </form>

            <div class="notice mt-5">

                <h5>
                    <i class="fa-solid fa-shield-halved me-2"></i>
                    Authorized Personnel Only
                </h5>

                <p>
                    This system is restricted to the Barangay Treasurer,
                    designated Staff, and Secretary only.
                    All actions are monitored and logged.
                </p>

            </div>

        </div>

    </div>


    <script src="{{ asset('js/login.js') }}"></script>

</body>
</html>