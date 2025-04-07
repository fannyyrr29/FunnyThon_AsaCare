@extends('layouts.app')

@section('title', 'Pengingat Minum Obat')

@section('header_title', 'Pengingat Minum Obat')

@section('content')
    <div class="container">
        <!-- Obat 1: Amlodipine -->
        <div class="medicine-card">
            <div class="medicine-info">
                <div>Pagi</div>
                <div class="medicine-name">Amlodipine</div>
                <div>1x sehari</div>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="amlodipineSwitch">
            </div>
        </div>

        <!-- Obat 2: Metformin -->
        <div class="medicine-card">
            <div class="medicine-info">
                <div>Pagi | Malam</div>
                <div class="medicine-name">Metformin</div>
                <div>2x sehari</div>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="metforminSwitch" checked>
            </div>
        </div>
    </div>

    <!-- Tombol Tambah -->
    <div class="add-button">
        <img src="{{ asset('assets/images/plus.png') }}" class="rounded d-block mx-auto" width="24" alt="Tambah">
    </div>
@endsection
