@extends('layouts.app')

@section('title', 'Toko Obat')
@section('header_title', 'Toko Obat')
@section('back_button', true)

@section('content')
    <div class="search-bar">
        <input type="text" placeholder="Cari disini">
        <i class="fas fa-search"></i>
    </div>

    <div class="row g-3">
        @foreach ($drugs as $drug)
            <div class="col-6">
                <div class="product-card text-center">
                    <img src="{{ asset('assets/images/mylanta.png') }}" class="rounded d-block mx-auto" alt="...">
                    <h6>{{ $drug->name }}</h6>
                    <strong>{{ $drug->price }}</strong>
                    <div>
                        <button class="btn-red-general py-2 px-4">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
