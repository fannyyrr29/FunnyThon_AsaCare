@extends('layouts.app')

@section('header_title', 'Home')
@section('header', 'AsaCare')

@section('content')

    <div class="min-vh-100 d-flex flex-column align-items-center justify-content-start text-center pt-5 position-relative">

        {{-- Profile Dokter --}}
        <div class="mb-4 position-relative" style="z-index: 2;">
            <img src="https://rsjpparamarta.com/images/dr-annisa-tri-kusuma-spn-TQ.png" alt="Foto Dokter"
                class="rounded-circle" width="120" height="120">
            <h5 class="mt-3 mb-1">dr. Siti Rahmawati</h5>
            <p class="text-muted mb-1">Spesialis Penyakit Dalam</p>
            <div>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star-half-alt text-warning"></i>
                <span class="ms-2 text-muted">4.5/5</span>
            </div>
        </div>

        {{-- Tombol Menu --}}
        <div class="row w-100 flex-column align-items-center" style="z-index: 2;">
            <div class="col-12 mb-3">
                <form action="{{ route('medicalRecord.index') }}" method="get">
                    <button type="submit" class="btn-red w-50 mx-auto d-block text-center p-3">
                        <img src="{{ asset('assets/images/diagnosa.png') }}" alt="Beli Obat" style="width: 80px;">
                        <h4 class="mt-2">Diagnosa</h4>
                    </button>
                </form>

            </div>
            <div class="col-12 mb-3">
                <form action="" method="get">
                    <button class="btn-red w-50 mx-auto d-block text-center p-3">
                        <img src="{{ asset('assets/images/chat.png') }}" alt="Pengingat Obat" style="width: 80px;">
                        <h4 class="mt-2">Chat Konsultasi</h4>
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
