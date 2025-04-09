<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'My App')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- PWA --}}
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    @stack('styles')
    {{-- Vite Styles utk css general--}}
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    <link rel="stylesheet" href="/asset/css/app.css">
</head>

<body>
    {{-- HEADER --}}
    <div class="header d-flex align-items-center px-3 py-3">
        @hasSection('back_button')
            <button onclick="window.history.back()" class="btn btn-link text-white me-2 p-0">
                <i class="fas fa-arrow-left"></i>
            </button>
        @endif
        <h5 class="mb-0">@yield('header_title', 'AsaCare')</h5>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="container">
        @yield('content')
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/sw.js') }}"></script>

    @stack('scripts')
</body>

</html>