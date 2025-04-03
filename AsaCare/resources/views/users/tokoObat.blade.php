<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Obat-obatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #A2191F;
            color: white;
            padding: 10px;
            font-weight: bold;
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

        .product-card {
            background: white;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .product-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .add-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #A2191F;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body style="background: #FFF8E1;">

    <div class="header">
        <i class="fas fa-store"></i>
        <span>Toko Obat-obatan</span>
    </div>

    <div class="container mt-3">
        <div class="search-bar">
            <input type="text" placeholder="Cari disini">
            <i class="fas fa-search"></i>
        </div>

        <div class="row g-3">
            <div class="col-6">
                <div class="product-card">
                    <img src="{{ asset('assets/images/mylanta.png') }}" class="rounded d-block mx-auto" alt="...">
                    <h6>Mylanta Sirup 150 ml</h6>
                    <strong>Rp48.900</strong>
                    <div>
                        <button class="add-button">
                            <img src="{{ asset('assets/images/plus.png') }}" class="rounded d-block mx-auto" alt="...">
                            <i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="product-card">
                    <img src="{{ asset('assets/images/neurobion.png') }}" class="rounded d-block mx-auto" alt="...">
                    <h6>Neurobion Forte 10 Tablet</h6>
                    <strong>Rp53.000</strong>
                    <div>
                        <button class="add-button">
                            <img src="{{ asset('assets/images/plus.png') }}" class="rounded d-block mx-auto" alt="...">
                            <i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="product-card">
                    <img src="{{ asset('assets/images/paracetamol.jpg') }}" class="rounded d-block mx-auto" alt="...">
                    <h6>Paracetamol 500 mg</h6>
                    <strong>Rp3.900</strong>
                    <div>
                        <button class="add-button">
                            <img src="{{ asset('assets/images/plus.png') }}" class="rounded d-block mx-auto" alt="...">
                            <i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="product-card">
                    <img src="{{ asset('assets/images/imboost.jpg') }}" class="rounded d-block mx-auto" alt="...">
                    <h6>Imboost Force 10 Kaplet</h6>
                    <strong>Rp89.500</strong>
                    <div>
                        <button class="add-button">
                            <img src="{{ asset('assets/images/plus.png') }}" class="rounded d-block mx-auto" alt="...">
                            <i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>