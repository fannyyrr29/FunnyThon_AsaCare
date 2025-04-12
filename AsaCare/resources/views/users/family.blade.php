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
                    <div class="profile-card d-flex align-items-center mb-2">
                        <img alt="Profile" class="rounded-circle" width="60" height="60"
                            src="{{ asset('assets/images/' . ($family->sender_id == Auth::id() ? $family->receiver->profile : $family->sender->profile)) }}">
                        <div class="ms-3">
                            <h5 class="mb-1" style="color:#A6192E;">
                                {{ $family->sender_id == Auth::id() ? $family->receiver->name : $family->sender->name }}
                            </h5>
                            <p class="mb-0 text-muted"><i class="fas fa-map-marker-alt"></i>
                                {{ $family->sender_id == Auth::id() ? $family->receiver->address : $family->sender->address }}
                            </p>
                        </div>
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
                                <p><strong>{{ $p->name }}</strong></p>
                                <p>{{ $p->email }}</p>
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
                                <p><strong>{{ $item->name }}</strong></p>
                                <p>{{ $item->email }}</p>
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
        let debounceTimer;
        document.getElementById('searchInput').addEventListener('keyup', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(searchItems, 300); // tunggu 300ms setelah ketikan terakhir
        });

        function searchItems() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let items = document.querySelectorAll(".profile-card");
            const authId = '{{ Auth::id() }}';
            $.ajax({
                type: "post",
                url: "{{ route('user.search') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: '<?php echo Auth::id(); ?>',
                    email: input
                },
                success: function(response) {
                    $('#list-search').empty();
                    if (response.users.length === 0) {
                        $('#list-search').append(`<li class="list-group-item text-muted">Tidak ditemukan</li>`);
                    } else {
                        response.users.forEach(element => {
                            $('#list-search').append(`
                                <li class="list-group-item d-flex gap-2 justify-content-between align-items-center">
                                    <div>
                                        <h6>${element.name}</h6>
                                        <p>${element.email}</p>
                                    </div>
                                    <form action="{{ route('user.add') }}" method="POST" class="d-flex align-items-center gap-1">
                                        @csrf
                                        <input type="hidden" name="receiver_id" value="${element.id}">
                                        <input type="hidden" name="sender_id" value="${authId}">
                                        <button type="submit" class="btn btn-success btn-sm">Tambah</button>
                                    </form>
                                </li>
                            `);
                        });

                    }
                }
            });

            console.log(response.users);


        }
        // function sendRequest() {
        //     let emailInput = document.getElementById("emailInput");
        //     let emailError = document.getElementById("emailError");
        //     let email = emailInput.value.trim();
        //     let isValid = true;

        //     emailError.innerText = "";

        //     if (email === "") {
        //         emailError.innerText = "Email tidak boleh kosong!";
        //         isValid = false;
        //     } else if (!email.includes("@") || !email.includes(".")) {
        //         emailError.innerText = "Format email tidak valid!";
        //         isValid = false;
        //     }

        //     if (isValid) {
        //         let modalElement = document.getElementById('searchModal');
        //         let modalInstance = bootstrap.Modal.getInstance(modalElement);
        //         modalInstance.hide();
        //     }
        // }
    </script>
@endpush
