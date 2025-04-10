<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Halamnan @yield('PageName')</title>

    <link rel="stylesheet" href="assets/css/app.css">
    <script src="{{ asset('assets/js/app.js') }}"></script>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid d-flex justify-content-end">
                <form action="{{ route('logout') }}" method="get"><button class="btn btn-outline-success"
                        type="submit">LOGOUT</button>
                </form>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/sw.js') }}"></script>
</body>

</html>
