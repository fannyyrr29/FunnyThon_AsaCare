@extends('layouts.app')

@section('title', 'Home Page')

@section('header_title', 'Home')

@section('content')
    <!-- Kartu Profil -->
    <div class="profile-card d-flex align-items-center">
        <img src="{{ '/assets/images/' . Auth::user()->profile }}" alt="Profile">
        <div class="ms-3 w-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="mb-1">Halo, <strong
                            style="color:#A6192E;">{{ Auth::user()->name ?? Auth::user()->email }}</strong></h5>
                    <p class="mb-0 text-muted"><i class="fas fa-map-marker-alt"></i>
                        {{ Auth::user()->address ?? 'Tentukan alamat' }} </p>
                </div>
                <a href="{{ route('user.showProfile') }}" class="btn-red-general">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>

    <!-- Reminder -->
    <div id="reminder" class="reminder">
        <span class="close-btn" onclick="closeReminder()">x</span>
        <h6>Jangan lupa minum obat</h6>
    </div>

    <!-- Pilihan Layanan -->
    <h6 class="text-center mt-4">Silahkan pilih salah satu opsi di bawah ini!</h6>
    <div class="container mt-2">
        <div class="row text-center g-3">
            <div class="col-md-6 col-6">
                <a href="{{ route('user.layanan') }}" class="text-reset text-decoration-none">
                    <button class="btn-red w-100">
                        <img class="bg-red img-fluid" src="{{ asset('assets/images/home.png') }}" alt="...">
                        <br>Layanan Rumah
                    </button>
                </a>
            </div>
            <div class="col-md-6 col-6">
                <a href="{{ route('user.drug') }}" class="text-reset text-decoration-none">
                    <button class="btn-red w-100">
                        <img class="bg-red img-fluid" src="{{ asset('assets/images/obat.png') }}" alt="...">
                        <br>Obat-obatan
                    </button>
                </a>
            </div>
            <div class="col-md-6 col-6">
                <a href="{{ route('user.family') }}" class="text-reset text-decoration-none">
                    <button class="btn-red w-100">
                        <img class="bg-red img-fluid" src="{{ asset('assets/images/family.png') }}" alt="...">
                        <br>Keluarga
                    </button>
                </a>
            </div>
            <div class="col-md-6 col-6">
                <a href="{{ route('user.medicalrecord', ['id' => Auth::id()]) }}" class="text-reset text-decoration-none">
                    <button class="btn-red w-100">
                        <img class="bg-red img-fluid" src="{{ asset('assets/images/history.png') }}" alt="...">
                        <br>Riwayat Medis
                    </button>
                </a>
            </div>
        </div>
        <!-- Bagaimana kabar hari ini -->
        <h6 class="text-center mt-2 mb-2">Bagaimana kabar hari ini?</h6>

        <div class="row text-center">
            @php
                $latestCondition = Auth::user()->conditions->last(); // Bisa null kalau belum ada data
            @endphp

            <div class="col-4">
                <form action="{{ route('user.mood') }}" method="POST">
                    @csrf
                    <input type="hidden" name="condition" value="Sehat">
                    <button type="submit"
                        class="mood-btn {{ optional($latestCondition)->condition === 'Sehat' ? 'mood-healthy' : '' }}">
                        <img src="{{ asset('assets/images/smile.png') }}" width="50" class="rounded d-block mx-auto mb-2"
                            alt="...">
                        Sehat
                    </button>
                </form>
            </div>

            <div class="col-4">
                <form action="{{ route('user.mood') }}" method="POST">
                    @csrf
                    <input type="hidden" name="condition" value="Kurang Sehat">
                    <button type="submit"
                        class="mood-btn {{ optional($latestCondition)->condition === 'Kurang Sehat' ? 'mood-mid' : '' }}">
                        <img src="{{ asset('assets/images/neutral.png') }}" width="50" class="rounded d-block mx-auto mb-2"
                            alt="...">
                        Netral
                    </button>
                </form>
            </div>

            <div class="col-4">
                <form action="{{ route('user.mood') }}" method="POST">
                    @csrf
                    <input type="hidden" name="condition" value="Sakit">
                    <button type="submit"
                        class="mood-btn {{ optional($latestCondition)->condition === 'Sakit' ? 'mood-sick' : '' }}">
                        <img src="{{ asset('assets/images/angry.png') }}" width="50" class="rounded d-block mx-auto mb-2"
                            alt="...">
                        Sakit
                    </button>
                </form>
            </div>

        </div>

        <!-- <div class="col-md-6 col-6">
                <a href="{{ route('user.call') }}" class="text-reset text-decoration-none">
                    <button class="btn-red w-100">
                        <img class="bg-red img-fluid" src="{{ asset('assets/images/telp.png') }}" alt="...">
                    </button>
                </a>
            </div> -->
        <div class="add-button" >
            <a href="{{ route('user.call') }}" class="text-reset text-decoration-none">
                <button class="btn-red h-100 rounded-circle p-0">
                    <img src="{{ asset('assets/images/telp.png') }}" width="24" alt="...">
                </button>
            </a>
        </div>


@endsection

    @push('scripts')
        <script>
            function changeMood(button) {
                document.querySelectorAll('.mood-btn').forEach(btn => {
                    btn.classList.remove('mood-healthy', 'mood-mid', 'mood-sick');
                });

                const mood = button.getAttribute('data-mood');

                if (mood === 'Sehat') {
                    button.classList.add('mood-healthy');
                } else if (mood === 'Kurang Sehat') {
                    button.classList.add('mood-mid');
                } else if (mood === 'Sakit') {
                    button.classList.add('mood-sick');
                }
            }
        </script>
    @endpush