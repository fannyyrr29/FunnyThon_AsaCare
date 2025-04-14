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
    @if (session('header'))
        <div class="alert alert-success">
            <p><strong>{{ session('header') }}</strong> {{ session('message') }}</p>
        </div>
    @elseif ($errors->has('header') && $errors->has('message'))
        <div class="alert alert-danger">
            <p><strong>{{ $errors->first('header') }}</strong> {{ $errors->first('message') }}</p>
        </div>
    @endif
    <div class="search-bar d-flex align-items-center bg-white p-2 rounded mt-3">
        <input type="text" id="searchInput" class="form-control border-0" placeholder="Cari disini" onkeyup="searchItems()">
        <i class="fas fa-search text-muted ms-2"></i>
    </div>
    <div id="contact">
        <ul id="list-search" class="list-group">
        </ul>
    </div>

    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="approved-tab" data-bs-toggle="tab" href="#approved" role="tab"
                aria-controls="approved" aria-selected="false">Diterima</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab"
                aria-controls="pending" aria-selected="true">Menunggu</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="request-tab" data-bs-toggle="tab" href="#request" role="tab" aria-controls="request"
                aria-selected="true">Permintaan</a>
        </li>
    </ul>

    <div class="tab-content mt-3" id="myTabContent">
        @if ($families != [])
            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                @foreach ($families as $family)
                    @php
                        $id = $family->sender_id == Auth::id() ? $family->receiver->id : $family->sender->id;
                    @endphp
                    <div class="profile-card d-flex align-items-center justify-content-between mb-2">
                        <div class="">
                            <img alt="Profile" class="rounded-circle" width="60" height="60"
                                src="{{ asset('assets/images/profile/' . ($family->sender_id == Auth::id() ? $family->receiver->profile ?? 'default-avatar.png' : $family->sender->profile ?? 'default-avatar.png')) }}">
                            <div class="ms-3">
                                <h5 class="mb-1" style="color:#A6192E;">
                                    {{ $family->sender_id == Auth::id() ? $family->receiver->name : $family->sender->name }}
                                </h5>
                                <p class="mb-0 text-muted"><i class="fas fa-map-marker-alt"></i>
                                    {{ $family->sender_id == Auth::id() ? $family->receiver->address : $family->sender->address }}
                                </p>
                            </div>
                        </div>
                        <button class="btn custom-btn" type="button" data-bs-target="#showMedicalRecord"
                            onclick="showListRecord({{ $id }})">Show</button>
                    </div>
                @endforeach
            </div>
        @endif
        @if ($pending != [])
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                @foreach ($pending as $p)
                    <div class="profile-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- data akun yang direquest -->
                            <div class="mb-0">
                                <img src="{{ asset('assets/images/profile/' . $p->profile) }}" alt="">
                                <div class="ms-3">
                                    <p><strong>{{ $p->name }}</strong></p>
                                    <p>{{ $p->email }}</p>
                                </div>
                            </div>
                            <form action="{{ route('user.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="sender_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="receiver_id" value="{{ $p->id }}">
                                <button class="btn custom-btn" type="submit">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if ($invitor != [])
            <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="pending-tab">
                @foreach ($invitor as $item)
                    <div class="profile-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- data akun yang direquest -->
                            <div class="mb-0">
                                <img src="{{ asset('assets/images/profile/' . $item->profile) }}" alt="">
                                <div class="ms-3">
                                    <p><strong>{{ $item->name }}</strong></p>
                                    <p>{{ $item->email }}</p>
                                </div>
                            </div>
                            <div class="">
                                <form action="{{ route('user.accept') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="sender_id" value="{{ $item->id }}">
                                    <input type="hidden" name="receiver_id" value="{{ Auth::id() }}">
                                    <button class="btn btn-success" type="submit">Tambah</button>
                                </form>
                                <form action="{{ route('user.delete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="sender_id" value="{{ $item->id }}">
                                    <input type="hidden" name="receiver_id" value="{{ Auth::id() }}">
                                    <button class="btn custom-btn" type="submit">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
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
        </div> --}}
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
                        <input type="text" id="emailInput" class="form-control" name="email"
                            placeholder="contoh@email.com">
                        <small id="emailError" class="text-danger"></small>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn custom-btn" onclick="sendRequest()">Kirim Permintaan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showMedicalRecord">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userName">Riwayat Kesehatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container-record">
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        let debounceTimer = null; // <--- tambahkan ini di awal

        document.getElementById('searchInput').addEventListener('keyup', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const activeTab = document.querySelector('.nav-link.active').id;
                const tabType = activeTab.replace('-tab', '');
                const typeMap = {
                    'approved': 'families',
                    'pending': 'pending',
                    'request': 'invitor'
                };

                searchItems(typeMap[tabType]);
            }, 300);
        });
    </script>

    <script>
        function searchItems(tab) {
            const email = document.getElementById("searchInput").value.trim();
            const userId = '{{ Auth::id() }}';

            if (email === "") {
                location.reload();
                return;
            }

            const tabToIdMap = {
                'pending': 'pending',
                'invitor': 'request',
                'families': 'approved'
            };

            $.ajax({
                type: "POST",
                url: "{{ route('user.search') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: userId,
                    email: email,
                    type: tab
                },
                success: function(response) {
                    const users = response.users;
                    const container = $(`#${tabToIdMap[tab]}`);
                    container.empty();

                    if (users.length === 0) {
                        container.append(`<div class="text-muted text-center p-3">Tidak ditemukan</div>`);
                        return;
                    }

                    users.forEach(user => {
                        let html = '';
                        const profileImage = user.profile ? user.profile : 'default-avatar.png';
                        const imageUrl = `/assets/images/profile/${profileImage}`;
                        if (tab === 'pending') {
                            html = `
                    <div class="profile-card d-flex justify-content-between align-items-center">
                        <div>
                            <img alt="Profile" class="rounded-circle" width="60" height="60"
                                src="${imageUrl}">
                            <p><strong>${user.name}</strong></p>
                            <p>${user.email}</p>
                        </div>
                        <form action="{{ route('user.delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="sender_id" value="${userId}">
                            <input type="hidden" name="receiver_id" value="${user.id}">
                            <button class="btn custom-btn" type="submit">Hapus</button>
                        </form>
                    </div>`;
                        } else if (tab === 'invitor') {
                            html = `
                    <div class="profile-card d-flex justify-content-between align-items-center">
                        <div>
                            <p><strong>${user.name}</strong></p>
                            <p>${user.email}</p>
                        </div>
                        <div>
                            <form action="{{ route('user.accept') }}" method="post">
                                @csrf
                                <input type="hidden" name="sender_id" value="${user.id}">
                                <input type="hidden" name="receiver_id" value="${userId}">
                                <button class="btn btn-success" type="submit">Tambah</button>
                            </form>
                            <form action="{{ route('user.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="sender_id" value="${user.id}">
                                <input type="hidden" name="receiver_id" value="${userId}">
                                <button class="btn custom-btn" type="submit">Hapus</button>
                            </form>
                        </div>
                    </div>`;
                        } else if (tab === 'families') {
                            html = `
                    <div class="profile-card d-flex align-items-center justify-content-between">
                        <div>
                            <img alt="Profile" class="rounded-circle" width="60" height="60"
                                src="${imageUrl}">
                            <p><strong>${user.name}</strong></p>
                            <p>${user.address}</p>
                        </div>
                        <button class="btn custom-btn" onclick="showListRecord(${user.id})">Show</button>
                    </div>`;
                        }

                        container.append(html);
                    });
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
            } else {
                const authId = '{{ Auth::id() }}';

                $.ajax({
                    type: "post",
                    url: "{{ route('user.add') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        sender_id: '<?php echo Auth::id(); ?>',
                        email: emailInput.value
                    },
                    success: function(response) {
                        console.log(response); // untuk melihat apa isi response-nya
                        if (response.status === 'SUCCESS') {
                            alert(response.message);
                            window.location.href = '/user/family';
                        } else {
                            alert("Gagal: " + response.message);
                        }
                    }
                });
            }

            if (isValid) {
                let modalElement = document.getElementById('searchModal');
                let modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();
            }
        }

        function showListRecord(id) {
            // console.log(id);

            $.ajax({
                type: "post",
                url: "{{ route('user.listRecord') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success: function(response) {
                    console.log(response);
                    let temp = "";
                    if (Array.isArray(response) && response.length > 0) {
                        for (const [index, value] of Object.entries(response)) {
                            let drugList = "";
                            for (const [i, drug] of Object.entries(value.drug_records)) {
                                drugList += `<li>${drug.drug.name} - ${drug.amount}x</li>`;
                            }

                            let actionList = "";
                            for (const [i, action] of Object.entries(value.actions)) {
                                actionList += `<li>${action.name} - ${action.date}</li>`;
                            }

                            temp += `<div class="card mb-3">
                            <div class="card-body">
                                <h5>${value.diagnose}</h5>
                                <h6>${value.description}</h6>
                                <p>${value.date}</p>
                                <p class="text-bold">Obat</p>
                                <ul>${drugList}</ul>
                                <p><strong>Layanan</strong></p>
                                <ul>${actionList}</ul>
                            </div>     
                        </div>`;
                        }
                    } else {
                        temp += `<div class="card mb-3">
                            <div class="card-body">
                                <p>Tidak Ditemukan Riwayat Kesehatan Pengguna</p>
                            </div>     
                        </div>`
                    }


                    $('#container-record').html(temp);
                    // $('#showMedicalRecord').modal('show');
                    let myModal = new bootstrap.Modal(document.getElementById('showMedicalRecord'));
                    myModal.show();
                }

            });
            // $('#container-record').modal('show');
        }
    </script>
@endpush
