<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #FDF6EC;
        }

        .profile-card {
            background-color: #FFF;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-red {
            background-color: #A6192E;
            color: white;
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            font-size: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 160px;
        }

        .btn-red img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            /* margin-bottom: 10px; */
        }

        .btn-red i {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .row {
            align-items: stretch;
        }

        .btn-red i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .mood-btn {
            width: 100%;
            padding: 5px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <!-- Kartu Profil -->
        <div class="profile-card d-flex align-items-center">
            <img src="https://media-cdn.tripadvisor.com/media/photo-s/19/85/23/30/my-grandma-on-a-trip.jpg"
                alt="Profile">
            <div class="ms-3">
                <h5 class="mb-1">Halo, <strong style="color:#A6192E;">Sri Haryati</strong> ✏️</h5>
                <p class="mb-0 text-muted"><i class="fas fa-map-marker-alt"></i> Jalan Merdeka No. 123</p>
            </div>
        </div>

        <!-- Pilihan Layanan -->
        <h6 class="text-center mt-4">Silahkan pilih salah satu opsi di bawah ini!</h6>
        <div class="row mt-3">
            <div class="col-6">
                <button class="btn btn-red text-center">
                    <img src="{{ asset('assets/images/home.png') }}" class="rounded d-block mx-auto" alt="...">
                    <i class="fas fa-home"></i><br>
                    Layanan Rumah
                </button>
            </div>
            <div class="col-6">
                <button class="btn btn-red text-center">
                    <img src="{{ asset('assets/images/obat.png') }}" class="rounded d-block mx-auto" alt="...">
                    <i class="fas fa-pills"></i><br>
                    Obat-obatan
                </button>
            </div>
            <div class="col-6 mt-2">
                <button class="btn btn-red text-center">
                    <img src="{{ asset('assets/images/history.png') }}" class="rounded d-block mx-auto" alt="...">
                    <i class="fas fa-file-medical"></i><br>
                    Riwayat Pengobatan
                </button>
            </div>
            <div class="col-6 mt-2">
                <button class="btn btn-red text-center">
                    <img src="{{ asset('assets/images/telp.png') }}" class="rounded d-block mx-auto" alt="...">
                    <i class="fas fa-phone"></i><br>
                    Telepon
                </button>
            </div>
        </div>

        <!-- Bagaimana kabar hari ini -->
        <h6 class="text-center mt-4">Bagaimana kabar hari ini?</h6>
        <div class="row text-center">
            <div class="col-4">
                <button class="mood-btn"><i class="far fa-smile" style="color: green;"></i>
                    <img src="{{ asset('assets/images/smile.png') }}" width="50" class="rounded d-block mx-auto"
                        alt="..."><br>Sehat</button>
            </div>
            <div class="col-4">
                <button class="mood-btn"><i class="far fa-meh" style="color: orange;"></i>
                    <img src="{{ asset('assets/images/neutral.png') }}" width="50"class="rounded d-block mx-auto"
                        alt="..."><br>Kurang Sehat</button>
            </div>
            <div class="col-4">
                <button class="mood-btn"><i class="far fa-frown" style="color: red;">
                        <img src="{{ asset('assets/images/angry.png') }}" width="50" class="rounded d-block mx-auto" alt="...">
                    </i><br>Sakit</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- PWA --}}
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
</body>

</html>