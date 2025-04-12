@extends('layouts.app')

@section('title', 'Dokter Konsultasi')

@section('header_title', 'Daftar Dokter')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @foreach ($doctors as $doctor)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <form action="{{ route('user.message') }}" method="POST">
                            @csrf
                            {{-- <input type="hidden" name="consultation_id" value="{{ $consultation->id }}"> --}}
                            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                            <input type="hidden" name="doctor_name" value="{{ $doctor->name }}">
                            <img src="{{'/assets/images/'. $doctor->profile }}" class="card-img-top" alt="{{ $doctor->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $doctor->name }}</h5>
                                <p class="card-text">
                                    <strong>Pengalaman:</strong> {{ $doctor->doctor->experience_year }} tahun<br>
                                    <strong>Rating:</strong> {{ $doctor->doctor->rating }}<br>
                                    <strong>Spesialis:</strong> {{ $doctor->doctor->specialization->name }}<br>
                                    @php
                                        $rating = $doctor->rating; 
                                        $fullStars = floor($rating);
                                        $halfStar = $rating - $fullStars > 0 ? 1 : 0;
                                        $emptyStars = 5 - $fullStars - $halfStar;
                                    @endphp
                                </p>
                                <button type="submit" class="btn btn-danger">Chat</button>
                                {{-- <a href="{{ route('chat', ['doctor_id' => $doctor->id]) }}" >Chat</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
