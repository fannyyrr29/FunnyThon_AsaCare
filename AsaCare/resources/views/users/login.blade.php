<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <section class="vh-100 d-flex align-items-center justify-content-center">
            <div class="container py-5">
                <div class="text-center">
                    <img src="{{ asset('assets/images/logo.png') }}" class="rounded" style="width: 150px; height: auto;"
                        alt="Logo">
                </div>
                <div class="row justify-content-center text-center">
                    <h1 class="mb-5">Masuk</h1>
                    <div class="card bg-transparent">
                        <div class="p-4">
                            <div class="form-outline mb-4">
                                <a href="auth/redirect" class="btn btn-primary btn-lg border-0 w-100"
                                    style="background-color: #a31d1c;"> <img src="assets/images/google.png" alt="Google Logo"
                                        width="24" height="24">   Masuk dengan Google</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>