@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-card {
            background-color: #FFF;
            border-radius: 12px;
            padding: 15px;
            margin: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .custom-btn {
            background-color: #A6192E;
            color: white;
            border-radius: 8px;
            padding: 10px 15px;
            border: none;
        }
    </style>
@endpush

@section('header_title', 'Home')

@section('content')
    <div class="search-bar d-flex align-items-center bg-white p-2 rounded mt-3">
        <input type="text" id="searchInput" class="form-control border-0" placeholder="Cari disini" onkeyup="searchItems()">
        <i class="fas fa-search text-muted ms-2"></i>
    </div>

    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="approved-tab" data-bs-toggle="tab" href="#approved" role="tab" aria-controls="approved"
                aria-selected="false">Approved</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab"
                aria-controls="pending" aria-selected="true">Pending</a>
        </li>
    </ul>

    <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
            <div class="profile-card">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- data akun yang direquest -->
                    <p class="mb-0">haryono_983@gmail.com</p>
                    <a class="btn custom-btn" href="#">Hapus</a>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
            <div class="profile-card d-flex align-items-center">
                <img src="https://media-cdn.tripadvisor.com/media/photo-s/19/85/23/30/my-grandma-on-a-trip.jpg"
                    alt="Profile" class="rounded-circle" width="60" height="60">
                <div class="ms-3">
                    <h5 class="mb-1"><strong style="color:#A6192E;">Sri Haryati</strong></h5>
                    <p class="mb-0 text-muted"><i class="fas fa-map-marker-alt"></i> Jalan Merdeka No. 123</p>
                </div>
            </div>
        </div>
    </div>

    <div class="add-button position-fixed bottom-0 end-0 m-3 bg-danger text-white rounded-circle d-flex justify-content-center align-items-center"
        style="width: 50px; height: 50px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#searchModal">
        <i class="fas fa-plus"></i>
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
@endsection

@push('scripts')
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
                let modalElement = document.getElementById('searchModal');
                let modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();
            }
        }
    </script>
@endpush