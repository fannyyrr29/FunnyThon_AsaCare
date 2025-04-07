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
        <div class="col-6">
            <div class="product-card text-center">
                <img src="{{ asset('assets/images/mylanta.png') }}" class="rounded d-block mx-auto" alt="...">
                <h6>Mylanta Sirup 150 ml</h6>
                <strong>Rp48.900</strong>
                <div>
                    <button class="btn-red-general py-2 px-4">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="product-card text-center">
                <img src="{{ asset('assets/images/neurobion.png') }}" class="rounded d-block mx-auto" alt="...">
                <h6>Neurobion Forte 10 Tablet</h6>
                <strong>Rp53.000</strong>
                <div>
                    <button class="btn-red-general py-2 px-4">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="product-card text-center">
                <img src="{{ asset('assets/images/paracetamol.jpg') }}" class="rounded d-block mx-auto" alt="...">
                <h6>Paracetamol 500 mg</h6>
                <strong>Rp3.900</strong>
                <div>
                    <button class="btn-red-general py-2 px-4">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="product-card text-center">
                <img src="{{ asset('assets/images/imboost.jpg') }}" class="rounded d-block mx-auto" alt="...">
                <h6>Imboost Force 10 Kaplet</h6>
                <strong>Rp89.500</strong>
                <div>
                    <button class="btn-red-general py-2 px-4">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
