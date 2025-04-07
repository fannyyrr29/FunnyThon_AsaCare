@extends('layouts.app')

@section('title', 'Kontak Darurat')
@section('header_title', 'Telepon')
@section('back_button', true)

@section('content')
    <div class="contact-card">
        <div>
            <h5>Rumah Sakit</h5>
            <p class="text-muted">RSUD Dr. Soetomo</p>
        </div>
        <div class="contact-icon">
            <img src="{{ asset('assets/images/telp.png') }}" alt="Telepon">
        </div>
    </div>

    <div class="contact-card">
        <div>
            <h5>Ambulance</h5>
            <p class="text-muted">112</p>
        </div>
        <div class="contact-icon">
            <img src="{{ asset('assets/images/telp.png') }}" alt="Telepon">
        </div>
    </div>

    <div class="contact-card">
        <div>
            <h5>Dina</h5>
            <p class="text-muted">Kontak Darurat</p>
        </div>
        <div class="contact-icon">
            <img src="{{ asset('assets/images/telp.png') }}" alt="Telepon">
        </div>
    </div>

    <button class="add-button">
        <img src="assets/images/plus.png" width="24" class="rounded d-block mx-auto" alt="...">
    </button>
@endsection