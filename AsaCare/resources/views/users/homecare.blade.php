<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Layanan Rumah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #A6192E;
            color: white;
            padding: 15px;
            font-size: 22px;
            display: flex;
            align-items: center;
            font-weight: bold;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        body {
            padding-top: 60px; 
        }
        .header i {
            margin-right: 10px;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 15px;
        }
        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .card-body {
            background-color: white;
            padding: 10px 15px;
        }
        .card-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .card-text {
            font-size: 14px;
            color: #555;
        }
        .logo{
            padding-right: 10px;
        }
    </style>
</head>
<body class="bg-light">

    <div class="header">
        <i class="fas fa-home"></i>
        <!-- <div class="logo"> <img src="assets/images/home.png" width="25px"> </div> -->
        <span>Layanan Rumah</span>
    </div>

    <div class="container mt-3">
        <div class="card">
            <img src="assets/images/pemeriksaan.jpg" alt="Pemeriksaan Kesehatan Rutin">
            <div class="card-body">
                <div class="card-title">Pemeriksaan Kesehatan Rutin</div>
                <div class="card-text">Cek tekanan darah, gula darah, kolesterol</div>
            </div>
        </div>

        <div class="card">
            <img src="assets/images/luka.jpg" alt="Perawatan Luka">
            <div class="card-body">
                <div class="card-title">Perawatan Luka</div>
                <div class="card-text">Luka diabetes, luka pasca operasi</div>
            </div>
        </div>

        <div class="card">
            <img src="assets/images/fisioterapi.jpg" alt="Fisioterapi di rumah">
            <div class="card-body">
                <div class="card-title">Fisioterapi di rumah</div>
                <div class="card-text">Pemulihan pasca stroke, terapi sendi</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
