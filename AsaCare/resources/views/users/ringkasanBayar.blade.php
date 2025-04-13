<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ringkasan Pembayaran</title>
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
    </style>
</head>

<body>
    <div class="header">
        <i class="fas fa-store"></i>
        <span>Ringkasan Pembayaran</span>
    </div>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="fw-bold">Alamat Pengantaran</h6>
                    <div class="d-flex justify-content-between">
                        <span><i class="bi bi-geo-alt-fill"></i> Jalan Merdeka No. 123</span>
                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Neurobion Forte 10 Tablet</h6>
                            <span class="text-danger">Rp53.000</span>
                        </div>
                        <div class="input-group" style="width: 100px;">
                            <button class="btn btn-outline-danger btn-sm">-</button>
                            <input type="text" class="form-control text-center" value="1" readonly>
                            <button class="btn btn-outline-danger btn-sm">+</button>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Imboost Force 10 Kaplet</h6>
                            <span class="text-danger">Rp89.500</span>
                        </div>
                        <div class="input-group" style="width: 100px;">
                            <button class="btn btn-outline-danger btn-sm">-</button>
                            <input type="text" class="form-control text-center" value="1" readonly>
                            <button class="btn btn-outline-danger btn-sm">+</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <h6>Rincian Pembayaran</h6>
                    <div class="d-flex justify-content-between">
                        <span>Harga</span>
                        <span>Rp142.500</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Biaya Pengiriman</span>
                        <span>Rp10.000</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold mt-2">
                        <span>Total Pembayaran</span>
                        <span>Rp132.500</span>
                    </div>
                </div>
                <hr>
                <div>
                    <h5 class="text-left" class="fw-bold">Bayar Tunai</h5>
                    <h5 class="text-right" class="fw-bold">{{ 'Rp132.500' }} </h5>
                    <button class="btn-red-general">Pesan Sekarang</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
