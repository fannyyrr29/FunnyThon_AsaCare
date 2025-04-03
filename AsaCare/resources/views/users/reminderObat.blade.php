<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengingat Minum Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #A6192E;
            color: white;
            padding: 15px;
            font-size: 18px;
            display: flex;
            align-items: center;
        }
        .header i {
            margin-right: 10px;
        }
        .container {
            background-color: #FDF5E6;
            min-height: 100vh;
            padding-bottom: 80px;
        }
        .medicine-card {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            margin: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ddd;
        }
        .medicine-info {
            font-size: 14px;
        }
        .medicine-name {
            font-weight: bold;
            font-size: 16px;
        }
        .add-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #A6192E;
            color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="header">
        <i class="fas fa-bell"></i>
        <span>Pengingat minum obat</span>
    </div>

    <div class="container">
        <!-- Obat 1: Amlodipine -->
        <div class="medicine-card">
            <div class="medicine-info">
                <div>Pagi</div>
                <div class="medicine-name">Amlodipine</div>
                <div>1x sehari</div>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="amlodipineSwitch">
            </div>
        </div>

        <div class="medicine-card">
            <div class="medicine-info">
                <div>Pagi | Malam</div>
                <div class="medicine-name">Metformin</div>
                <div>2x sehari</div>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="metforminSwitch" checked>
            </div>
        </div>
    </div>

    <!-- Tombol Tambah -->
    <div class="add-button">
    <img src="{{ asset('assets/images/plus.png') }}" class="rounded d-block mx-auto" width="24" alt="...">
        <i class="fas fa-plus"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
