<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background-color: #fefae1;
        }

        .card {
            border-radius: 1rem;
            border: none;
        }

        .btn-google {
            width: 100%;
            background-color: #a31d1c;
            border: none;
        }

        /* Pastikan input tidak ketutupan ikon */
        .form-control {
            padding-right: 40px;
        }

        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <section class="vh-100 d-flex align-items-center justify-content-center">
            <div class="container py-5">
                <div class="text-center">
                    <img src="{{ asset('assets/images/logo.png') }}" class="rounded" style="width: 200px; height: auto;"
                        alt="Logo">
                </div>
                <div class="row justify-content-center text-center">
                    <h1 class="mb-3 mt-2">Masuk</h1>
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-transparent">
                            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                <div class="card-body text-center">
                                    <div class="p-3">
                                        <form action="{{ route('login') }}" method="post">
                                            @csrf
                                            <div class="form-outline mb-4">
                                                @error('account')
                                                    <p class="text-danger text-start">{{ $message }}</p>
                                                @enderror
                                                <input type="email" id="typeEmailX-2" name="email"
                                                    class="form-control form-control-lg" placeholder="Email" />
                                            </div>

                                            <div class="form-outline mb-4 position-relative">
                                                @error('password')
                                                    <p class="text-start text-danger">{{ $message }}</p>
                                                @enderror
                                                <input type="password" id="passwordField" name="password"
                                                    class="form-control form-control-lg" placeholder="Password" />
                                                <i class="fas fa-eye toggle-password"></i>
                                            </div>

                                            <div class="form-check d-flex justify-content-start mb-4">
                                                <input class="form-check-input" type="checkbox" id="form1Example3" />
                                                <label class="form-check-label" for="form1Example3"> Remember password
                                                </label>
                                            </div>

                                            <button class="btn btn-primary btn-lg btn-block w-100 border-0"
                                                style="background-color: #a31d1c;" type="submit">Login</button>
                                        </form>
                                    </div>

                                    <hr class="my-2">

                                    <div class="p-4">
                                        <div class="form-outline mb-2">
                                            <a href="auth/redirect" class="btn btn-primary btn-lg border-0 w-100"
                                                style="background-color: #a31d1c;">
                                                <img src="assets/images/google.png" alt="Google Logo" width="24"
                                                    height="24">
                                                Masuk dengan Google
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordField = document.getElementById("passwordField");
            const togglePassword = document.querySelector(".toggle-password");

            togglePassword.addEventListener("click", function() {
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    togglePassword.classList.remove("fa-eye");
                    togglePassword.classList.add("fa-eye-slash");
                } else {
                    passwordField.type = "password";
                    togglePassword.classList.remove("fa-eye-slash");
                    togglePassword.classList.add("fa-eye");
                }
            });
        });
    </script>
</body>

</html>
