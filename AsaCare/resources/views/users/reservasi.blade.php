@extends('layouts.app')

@section('title', 'Jadwalkan Tindakanmu')

@section('header_title', 'Layanan Rumah')

@section('content')
    <div class="text-center mb-3 fw-semibold">Kapan staf medis perlu tiba di rumah Anda?</div>

    {{-- Tanggal --}}

    <h5>&nbsp;April</h5>
    <div class="d-flex justify-content-between mb-3">
        <div class="date-card date-active">Sel<br>08</div>
        <div class="date-card">Rab<br>09</div>
        <div class="date-card">Kam<br>10</div>
        <div class="date-card">Jum<br>11</div>
        <div class="date-card">Sab<br>12</div>
    </div>

    {{-- Slot Waktu --}}
    <div class="mb-3">
        <div class="fw-bold">Pagi</div>
        <div class="d-flex flex-wrap gap-2">
            <div class="time-slot">11:00</div>
        </div>
    </div>

    <div class="mb-3">
        <div class="fw-bold">Siang</div>
        <div class="d-flex flex-wrap gap-2">
            <div class="time-slot time-selected">12:00</div>
            <div class="time-slot disabled text-muted">13:00</div>
            <div class="time-slot">14:00</div>
        </div>
    </div>

    <div class="mb-3">
        <div class="fw-bold">Sore</div>
        <div class="d-flex flex-wrap gap-2">
            <div class="time-slot">15:00</div>
        </div>
    </div>
    <!-- route ke ringkasanBayar -->
    <a href="{{ url('/ringkasanBayar') }}" class="btn-red-general">
        <h6>Lanjut</h6>
    </a>
@endsection