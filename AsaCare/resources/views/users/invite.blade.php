<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Undangan</title>
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
            margin-bottom: 160px;
        }

        .container {
            margin-top: 100px;
        }

        .card-body h5 {
            color: #A6192E;
        }
    </style>
</head>

<body>
    <div class="header">
        <i class="fas fa-home"></i>
        <span>Undang Keluarga</span>
    </div>
    <div class="container"></div>
    <div class="container text-center mt-5">
        <div class="card mx-auto mt-4" style="max-width: 400px;">
            <div class="card-body">
                <img src="assets/images/keluarga.jpg" class="img-fluid mb-3" width="200px">
                <h5 class="text-success fw-bold">Undangan</h5>
                <div class="d-flex justify-content-center align-items-center">
                    <input type="text" class="form-control text-center fw-bold" value="SRIH-B0671F" readonly
                        style="max-width: 200px;">
                    <button class="btn btn-outline-primary ms-2" onclick="copyCode()">Salin</button>
                </div>
                <p class="mt-3">Undang keluarga Anda</p>
                <p class="text-muted small">Dengan membagikan kode ini, dapat membantu keluarga anda memantau kondisi
                    fisik Anda</p>
            </div>
        </div>
    </div>
    <script>
        function copyCode() {
            const input = document.querySelector("input");
            input.select();
            document.execCommand("copy");
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>