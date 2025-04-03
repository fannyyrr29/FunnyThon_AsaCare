<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Darurat</title>
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

        .contact-card {
            background: white;
            margin: 10px;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .contact-icon {
            background: #A2191F;
            color: white;
            padding: 10px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
        }

        .contact-icon img {
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .contact-icon i {
            font-size: 20px;
        }

        .add-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #A2191F;
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body style="background: #FFF8E1;">

    <div class="header">
        <i class="fas fa-phone"></i>
        <span>Telepon</span>
    </div>

    <div class="container mt-3">
        <div class="contact-card">
            <div>
                <h5>Rumah Sakit</h5>
                <p class="text-muted">RSUD Dr. Soetomo</p>
            </div>
            <div class="contact-icon">
                <img src="{{ asset(path: 'assets/images/telp.png') }}" alt="Telepon">
            </div>
        </div>

        <div class="contact-card">
            <div>
                <h5>Ambulance</h5>
                <p class="text-muted">112</p>
            </div>
            <div class="contact-icon">
                <img src="{{ asset(path: 'assets/images/telp.png') }}" alt="Telepon">
            </div>
        </div>

        <div class="contact-card">
            <div>
                <h5>Dina</h5>
                <p class="text-muted">Kontak Darurat</p>
            </div>
            <div class="contact-icon">
                <img src="{{ asset(path: 'assets/images/telp.png') }}" alt="Telepon">
            </div>
        </div>
    </div>

    <button class="add-button">
        <img src="{{ asset('assets/images/plus.png') }}" width="24" class="rounded d-block mx-auto" alt="...">
        <i class="fas fa-plus"></i></button>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>