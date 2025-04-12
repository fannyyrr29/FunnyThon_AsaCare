<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'AsaCare')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

    {{-- PWA --}}
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    @stack('styles')

    <link rel="stylesheet" href="assets/css/app.css">
    <script src="{{ asset('assets/js/app.js') }}"></script>

</head>

<body>
    {{-- HEADER --}}
    <div class="header d-flex align-items-center px-3 py-3" style="background-color: #A2191F; color: white;">

        {{-- Logo AsaCare hanya muncul di halaman 'user' --}}
        @if (Request::is('user'))
            <a class="navbar-brand d-flex align-items-center text-white text-decoration-none me-auto" href="/user">
                <img src="{{ asset('assets/images/logo no-text.png') }}" alt="Logo" width="32" height="32"
                    class="me-2">
                <span>AsaCare</span>
            </a>
        @endif

        {{-- Tampilkan header_title jika bukan halaman 'user' --}}
        @if (!Request::is('user'))
            <img src="{{ asset('assets/images/logo no-text.png') }}" alt="Logo" width="32" height="32"
                class="me-2">
            <h5 class="mb-0 flex-grow-1">@yield('header_title')</h5>
        @endif

        {{-- Tombol Logout hanya muncul di halaman 'user' --}}
        @if (Request::is('user'))
            <form class="ms-auto" action="{{ route('logout') }}">
                <button class="btn btn-outline-light" type="submit">LOGOUT</button>
            </form>
        @endif
    </div>

    {{-- MAIN CONTENT --}}
    <div class="container">
        @yield('content')
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/sw.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    @stack('scripts')
</body>

</html>
