@extends('layouts.app')

@section('header_title', 'Obat')

@section('content')

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 flex-column align-items-center">
            <div class="col-12 mb-3">
                <button class="btn-red w-50 mx-auto d-block">
                    <img src="{{ asset('assets/images/reminder.png') }}" alt="Pengingat Obat">
                    <h4>Pengingat minum obat</h4>
                </button>
            </div>
            <div class="col-12 mb-3">
                <button class="btn-red w-50 mx-auto d-block">
                    <img src="{{ asset('assets/images/apotik.png') }}" alt="Beli Obat">
                    <h4>Beli obat</h4>
                </button>
            </div>
            <div class="col-12 mb-3">
                <button class="btn-red w-50 mx-auto d-block">
                    <img src="{{ asset('assets/images/history.png') }}" alt="Riwayat">
                    <h4>Riwayat beli obat</h4>
                </button>
            </div>
        </div>
    </div>

@endsection