<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengingat Minum Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #fdf6e3;
        }
        .container {
            max-width: 400px;
            margin-top: 20px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #b22222;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .btn-primary {
            background-color: #b22222;
            border: none;
        }
        .btn-primary:hover {
            background-color: #8b1a1a;
        }
        .btn-selected {
            background-color: #b22222;
            color: white;
        }
        .btn-option {
            background-color: #f8f9fa;
            color: black;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h5 class="mb-0">Pengingat Minum Obat</h5>
    </div>
    <h6 class="text-center mt-3">Tambah Pengingat</h6>

    <div class="mb-3">
        <label for="namaObat" class="form-label">Nama Obat</label>
        <select id="namaObat" class="form-select">
            <option>Pilih Obat</option>
            <option>Paracetamol</option>
            <option>Amoxicillin</option>
            <option>Ibuprofen</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Jadwal Minum <span class="fw-bold">1 x sehari</span></label>
        <div class="d-flex justify-content-between">
            <button class="btn btn-selected w-25">Pagi 🌅</button>
            <button class="btn btn-option w-25">Siang ☀️</button>
            <button class="btn btn-option w-25">Malam 🌙</button>
        </div>
    </div>

    <button class="btn btn-primary w-100">Simpan</button>
</div>

</body>
</html>
