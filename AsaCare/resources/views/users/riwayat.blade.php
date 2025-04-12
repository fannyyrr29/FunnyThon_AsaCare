@extends('layouts.app')

@section('title', 'Riwayat Pengobatan')

@section('header_title', 'Riwayat Pengobatan')

@section('content')
    <div class="container mt-3">
        {{-- @foreach ($medicalRecords as $medicalRecord)
            <div class="card-custom">
                <h5>{{ $medicalRecord->diagnose }}</h5>
                <p><strong>Catatan:</strong></p>
                <ul>
                    @foreach ($drugs as $drug)
                        @if ($drug->medical_record_id == $medicalRecord->id)
                            <li>{{ $drug->nama . ' ' . $drug->dosis . ' ' . $drug->periode }}</li>
                        @endif
                    @endforeach

                    @foreach ($medicalRecord->actions as $actionRecord)
                        <li>{{ $actionRecord->name . ' ' . $actionRecord->created_at }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach --}}
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
