@extends('layouts.app')

@section('title', 'Riwayat Pengobatan')

@section('header_title', 'Riwayat Pengobatan')

@section('content')
    <div class="container mt-3">
        <div class="card-custom">
            <h5>Hipertensi</h5>
            <p><strong>Catatan:</strong></p>
            <ul>
                <li>Konsumsi Amlodipine 1x sehari</li>
                <li>Konsultasi rutin dalam 12 hari</li>
            </ul>
        </div>

        <div class="card-custom">
            <h5>Diabetes Mellitus Tipe 2</h5>
            <p><strong>Catatan:</strong></p>
            <ul>
                <li>Konsumsi Metformin 2x sehari</li>
                <li>Konsultasi rutin dalam 30 hari</li>
            </ul>
        </div>
    </div>
@endsection