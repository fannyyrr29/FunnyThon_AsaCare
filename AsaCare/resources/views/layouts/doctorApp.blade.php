<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

    <title>Halaman @yield('PageName')</title>

    <link rel="stylesheet" href="assets/css/app.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .card,
        .table {
            background-color: #fdf6ec !important;
        }

        .navbar {
            background-color: #A2191F !important;
            color: white !important;
        }

        .navbar a {
            color: white !important;
        }
    </style>
    @yield('style')
</head>

<body>
    <nav class="navbar bg-body-tertiary mb-5">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('medicalRecord.index') }}">
                <img src="{{ asset('assets/images/logo no-text.png') }}" alt="Logo" width="32" height="32" class="me-2">
                <span>AsaCare</span>
            </a>
            <form class="d-flex" action="{{ route('logout') }}">
                <button class="btn btn-outline-light" type="submit">LOGOUT</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('/sw.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @yield('script')
</body>

</html>