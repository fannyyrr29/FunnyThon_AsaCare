<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- PWA -->
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
            margin: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
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
            cursor: pointer;
        }

        .add-button i {
            color: white;
        }

        .custom-btn {
            background-color: #A6192E;
            color: white;
            border-radius: 8px;
            padding: 10px 15px;
            border: none;
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
            <input type="text" id="searchInput" placeholder="Cari disini" onkeyup="searchItems()">
            <i class="fas fa-search"></i>
        </div>

        <div class="search-results" id="results">
            <ul class="list-group-item">
                <li class="profile-card d-flex align-items-center">
                    <img src="https://media-cdn.tripadvisor.com/media/photo-s/19/85/23/30/my-grandma-on-a-trip.jpg"
                        alt="Profile">
                    <div class="ms-3">
                        <h5 class="mb-1"><strong style="color:#A6192E;">Sri Haryati</strong></h5>
                        <p class="mb-0 text-muted"><i class="fas fa-map-marker-alt"></i> Jalan Merdeka No. 123</p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Tombol Tambah -->
        <div class="add-button" data-bs-toggle="modal" data-bs-target="#searchModal">
            <img src="{{ asset('assets/images/plus.png') }}" class="rounded d-block mx-auto" width="24" alt="...">
            <i class="fas fa-plus"></i>
        </div>

    </div>

    <!-- Modal Input Email -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Kirim Permintaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="emailForm">
                        <label for="emailInput" class="form-label">Masukkan Email</label>
                        <input type="text" id="emailInput" class="form-control" placeholder="contoh@email.com">
                        <small id="emailError" class="text-danger"></small>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn custom-btn" onclick="sendRequest()">Kirim Permintaan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function searchItems() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let items = document.querySelectorAll(".profile-card");

            items.forEach(item => {
                if (item.textContent.toLowerCase().includes(input)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        }


        function sendRequest() {
            let emailInput = document.getElementById("emailInput");
            let emailError = document.getElementById("emailError");
            let email = emailInput.value.trim();
            let isValid = true;

            emailError.innerText = "";

            if (email === "") {
                emailError.innerText = "Email tidak boleh kosong!";
                isValid = false;
            } else if (!email.includes("@") || !email.includes(".")) {
                emailError.innerText = "Format email tidak valid!";
                isValid = false;
            }

            if (isValid) {
                // Tutup modal setelah pengiriman sukses
                let modalElement = document.getElementById('searchModal');
                let modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/sw.js') }}"></script>
</body>

</html>