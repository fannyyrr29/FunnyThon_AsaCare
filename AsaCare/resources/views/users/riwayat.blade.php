@extends('layouts.app')

@section('title', 'Riwayat Pengobatan')

@section('header_title', 'Riwayat Pengobatan')

@section('content')
    <div class="container mt-3">
        @foreach ($medicalRecords as $medicalRecord)
            <div class="card-custom">
                <h5>{{ $medicalRecord['diagnose'] }}</h5>
                <h6>Oleh: {{ $medicalRecord['doctor']->name }}</h6>
                <p>Pada: {{ \Carbon\Carbon::parse($medicalRecord['date'])->format('d M Y') }}</p>
                <p><strong>Obat:</strong></p>
                <ul>
                    @foreach ($medicalRecord['drugs'] as $drug)
                        <li>{{ $drug->name }} ({{ $drug->amount }}x)</li>
                    @endforeach
                </ul>
                <p><strong>Layanan:</strong></p>
                <ul>
                    @foreach ($medicalRecord['actions'] as $actionRecord)
                        <li>{{ $actionRecord->name }} -
                            {{ \Carbon\Carbon::parse($actionRecord->action_time)->format('d M Y') }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
        {{-- <div class="card-custom">
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
        </div> --}}
    </div>
@endsection
