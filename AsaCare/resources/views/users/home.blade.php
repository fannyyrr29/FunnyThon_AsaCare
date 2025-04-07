@extends('layouts.app')

@section('title', 'Home Page')

@section('header_title', 'Home')

@section('content')
    <!-- Kartu Profil -->
    <div class="profile-card d-flex align-items-center">
        <img src="https://media-cdn.tripadvisor.com/media/photo-s/19/85/23/30/my-grandma-on-a-trip.jpg" alt="Profile">
        <div class="ms-3 w-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="mb-1">Halo, <strong style="color:#A6192E;">Sri Haryati</strong></h5>
                    <p class="mb-0 text-muted"><i class="fas fa-map-marker-alt"></i> Jalan Merdeka No. 123</p>
                </div>
                <a href="{{ route('user.editProfile') }}" class="btn-red-general">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>

<br>
    <!-- Pilihan Layanan -->
    <h6 class="text-center mt-4">Silahkan pilih salah satu opsi di bawah ini!</h6>
    <div class="row mt-2 text-center">
        <div class="col-4">
            <button class="btn-red">
                <img class="btn-red img" src="{{ asset('assets/images/home.png') }}" alt="...">
                <br>Layanan Rumah
            </button>
        </div>
        <div class="col-4">
            <button class="btn-red">
                <img class="btn-red img" src="{{ asset('assets/images/obat.png') }}" alt="...">
                <br>Obat-obatan
            </button>
        </div>
        <div class="col-4">
            <button class="btn-red">
                <img class="btn-red img" src="{{ asset('assets/images/family.png') }}" alt="...">
                <br>Keluarga
            </button>
        </div>
        <div class="col-4">
            <button class="btn-red">
                <img class="btn-red img" src="{{ asset('assets/images/history.png') }}" alt="...">
                <br>Riwayat Medis
            </button>
        </div>
        <div class="col-4">
            <button class="btn-red  ">
                <img class="btn-red img" src="{{ asset('assets/images/telp.png') }}" alt="...">
                <br>Telepon
            </button>
        </div>
    </div>

    <!-- Bagaimana kabar hari ini -->
    <div class="container mt-2">
        <h6 class="text-center mt-2">Bagaimana kabar hari ini?</h6>
        <div class="row text-center">
            <div class="col-4">
                <button class="mood-btn" onclick="changeMood(this)" data-mood="healthy">
                    <img src="{{ asset('assets/images/smile.png') }}" width="50" class="rounded d-block mx-auto" alt="...">
                    <br>Sehat
                </button>
            </div>
            <div class="col-4">
                <button class="mood-btn" onclick="changeMood(this)" data-mood="mid">
                    <img src="{{ asset('assets/images/neutral.png') }}" width="50" class="rounded d-block mx-auto"
                        alt="...">
                    <br>Netral
                </button>
            </div>
            <div class="col-4">
                <button class="mood-btn" onclick="changeMood(this)" data-mood="sick">
                    <img src="{{ asset('assets/images/angry.png') }}" width="50" class="rounded d-block mx-auto" alt="...">
                    <br>Sakit
                </button>
            </div>
        </div>
@endsection

    @push('scripts')
        <script>
            function changeMood(button) {
                document.querySelectorAll('.mood-btn').forEach(btn => {
                    btn.classList.remove('mood-healthy', 'mood-mid', 'mood-sick');
                });

                const mood = button.getAttribute('data-mood');

                if (mood === 'healthy') {
                    button.classList.add('mood-healthy');
                } else if (mood === 'mid') {
                    button.classList.add('mood-mid');
                } else if (mood === 'sick') {
                    button.classList.add('mood-sick');
                }
            }
        </script>
    @endpush