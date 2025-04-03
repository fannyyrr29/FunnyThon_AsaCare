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

    <style>
        .header {
            background-color: #A2191F;
            color: white;
            padding: 10px;
            font-weight: bold;
            font-size: 24px;
            display: flex;
            align-items: center;
        }

        .header i {
            margin-right: 10px;
        }

        .search-bar {
            margin: 10px;
            display: flex;
            align-items: center;
            background: white;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .search-bar input {
            border: none;
            outline: none;
            flex-grow: 1;
        }

        .search-bar i {
            color: gray;
        }

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
            width: 100px;
            height: 100px;
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
        }

        .btn-red i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .row {
            align-items: stretch;
            margin-bottom: 20px;
        }

        .mood-btn {
            width: 100%;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        .link-invitation {
            color: #A6192E;
        }

        h6.text-center {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <i class="fas fa-store"></i>
        <span>Home</span>
    </div>

    <div class="container mt-3">
        <div class="search-bar">
            <input type="text" placeholder="Cari disini">
            <i class="fas fa-search"></i>
        </div>
        <div class="container mt-4">
            <!-- Kartu Profil -->
            <div class="profile-card d-flex align-items-center">
                <img src="https://media-cdn.tripadvisor.com/media/photo-s/19/85/23/30/my-grandma-on-a-trip.jpg"
                    alt="Profile">
                <div class="ms-3">
                    <h5 class="mb-1"><strong style="color:#A6192E;">Sri Haryati</strong></h5>
                    <p class="mb-0 text-muted"><i class="fas fa-map-marker-alt"></i> Jalan Merdeka No. 123</p>
                    <p class="mb-1"><strong style="color:#000000;">Kondisi Hari ini :</strong></h5>
                </div>
            </div>

            <!-- Pilihan Layanan -->
            <h6 class="text-center mt-4">Silahkan pilih salah satu opsi di bawah ini!</h6>
            <div class="row mt-3">
                <div class="col-6">
                    <button class="btn-red text-center">
                        <img src="{{ asset('assets/images/home.png') }}" class="rounded d-block mx-auto" alt="...">
                        <i class="fas fa-home"></i><br>
                        Layanan Rumah
                    </button>
                </div>
                <div class="col-6">
                    <button class="btn-red text-center">
                        <img src="{{ asset('assets/images/obat.png') }}" class="rounded d-block mx-auto" alt="...">
                        <i class="fas fa-pills"></i><br>
                        Obat-obatan
                    </button>
                </div>
                <div class="col-6 mt-2">
                    <button class="btn-red text-center">
                        <img src="{{ asset('assets/images/history.png') }}" class="rounded d-block mx-auto" alt="...">
                        <i class="fas fa-file-medical"></i><br>
                        Riwayat Medis
                    </button>
                </div>
                <div class="col-6 mt-2">
                    <button class="btn-red text-center">
                        <img src="{{ asset('assets/images/telp.png') }}" class="rounded d-block mx-auto" alt="...">
                        <i class="fas fa-phone"></i><br>
                        Telepon
                    </button>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        {{-- PWA --}}
        <script src="{{ asset('/sw.js') }}"></script>
</body>

</html>