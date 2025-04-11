@extends('layouts.doctorApp')

@section('header_title', 'Home')
@section('header', 'AsaCare')

@section('content')

    <div class="min-vh-100 d-flex flex-column align-items-center justify-content-start text-center pt-5 position-relative">

        {{-- Profile Dokter --}}
        <div class="mb-4 position-relative" style="z-index: 2;">
            <img src="assets/images/{{$user->profile}}" alt="Foto Dokter" class="rounded-circle img-crop">
            <h5 class="mt-3 mb-1">{{ $doctor->name }}</h5>
            <p class="text-muted mb-1">{{ $specialization->name }}</p>
            <div>
                @php
                    $rating = $doctor->rating; // Misalnya, $doctor->rating adalah 3.5
                    $fullStars = floor($rating);
                    $halfStar = $rating - $fullStars > 0 ? 1 : 0;
                    $emptyStars = 5 - $fullStars - $halfStar;
                @endphp

                @for ($i = 0; $i < $fullStars; $i++)
                    <i class="fas fa-star text-warning"></i>
                @endfor

                @if ($halfStar)
                    <i class="fas fa-star-half-alt text-warning"></i>
                @endif

                @for ($i = 0; $i < $emptyStars; $i++)
                    <i class="fas fa-star text-muted"></i>
                @endfor

                <span class="ms-2 text-muted">{{ $doctor->rating }}/5</span>
            </div>

        </div>

        {{-- Tombol Menu --}}
        <div class="row w-50 d-flex flex-column flex-md-row align-items-center justify-content-center gap-3"
            style="z-index: 2;">
            <div class="col-12 col-md-5">
                <form action="{{ route('medicalRecord.index') }}" method="get">
                    <button type="submit" class="btn-red w-100 d-flex flex-column align-items-center p-3">
                        <img src="{{ asset('assets/images/diagnosa.png') }}" alt="Diagnosa" style="width: 80px;">
                        <h4 class="mt-2">Diagnosa</h4>
                    </button>
                </form>
            </div>
            <div class="col-12 col-md-5">
                <form action="" method="get">
                    <button class="btn-red w-100 d-flex flex-column align-items-center p-3">
                        <img src="{{ asset('assets/images/chat.png') }}" alt="Chat Konsultasi" style="width: 80px;">
                        <h4 class="mt-2">Chat Konsultasi</h4>
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection