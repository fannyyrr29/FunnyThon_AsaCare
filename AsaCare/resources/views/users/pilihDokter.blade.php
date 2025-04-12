@extends('layouts.app')

@section('title', 'Dokter Konsultasi')

@section('header_title', 'Daftar Dokter')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @foreach ($doctors as $doctor)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="assets/images/{{ $user->profile }}" class="card-img-top" alt="{{ $doctor->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $doctor->name }}</h5>
                                <p class="card-text">
                                    <strong>Pengalaman:</strong> {{ $doctor->experience_year }} tahun<br>
                                    <strong>Rating:</strong> {{ $doctor->rating }}<br>
                                    @php
                                        $rating = $doctor->rating; // Misalnya, $doctor->rating adalah 3.5
                                        $fullStars = floor($rating);
                                        $halfStar = $rating - $fullStars > 0 ? 1 : 0;
                                        $emptyStars = 5 - $fullStars - $halfStar;
                                    @endphp
                                </p>
                                <a href="{{ route('chat', ['doctor_id' => $doctor->id]) }}" class="btn btn-danger">Chat</a>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
@endsection