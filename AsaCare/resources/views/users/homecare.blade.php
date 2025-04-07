@extends('layouts.app')

<!-- @section('title', 'Layanan Rumah') -->
@section('header_title', 'Layanan Rumah')

@section('content')
    <div class="container mt-3">
        <!-- nanti isinya di foreach dari tabel actions type: HOMECARE pesan, type:hospital booking -->

        <div class="card">
            <img src="{{ asset('assets/images/pemeriksaan.jpg') }}" alt="Pemeriksaan Kesehatan Rutin">
            <div class="card-body">
                <div class="card-title">Pemeriksaan Kesehatan Rutin</div>
                <div class="card-text">Cek tekanan darah, gula darah, kolesterol</div>
                <br>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="card-title" >Rp120.000</div>
                    <!-- route ke reservasi -->
                    <a href="{{ url('/reservasi') }}" class="btn-red-general">
                        <h6>Reservasi</h6>
                    </a>
                </div>
            </div>
        </div>


        <div class="card">
            <img src="{{ asset('assets/images/luka.jpg') }}" alt="Perawatan Luka">
            <div class="card-body">
                <div class="card-title">Perawatan Luka</div>
                <div class="card-text">Luka diabetes, luka pasca operasi</div>
            </div>
        </div>

        <div class="card">
            <img src="{{ asset('assets/images/fisioterapi.jpg') }}" alt="Fisioterapi di rumah">
            <div class="card-body">
                <div class="card-title">Fisioterapi di rumah</div>
                <div class="card-text">Pemulihan pasca stroke, terapi sendi</div>
            </div>
        </div>
    </div>
@endsection