@extends('layouts.app')

@section('title', 'Checkout')
@section('header_title', 'Checkout')
@section('back_button', true)

@push('styles')
    <style>
        .checkout-card {
            background-color: #fdf6ec;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .checkout-card img {
            max-height: 80px;
            object-fit: contain;
        }

        .total-section {
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 1rem;
            color: #A6192E;
        }

        .user-info {
            margin-bottom: 1.5rem;
            background-color: #fff;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi Kesalahan!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @elseif (session('header'))
        <div class="alert alert-success">
            <p><strong>{{ session('header') }}</strong> {{ session('message') }}</p>
        </div>
    @endif

    <div class="user-info">
        <h5>Informasi Pembeli</h5>
        <p><strong>Nama:</strong> {{ $user['name'] }}</p>
        <p><strong>Alamat:</strong> {{ $user['address'] }}</p>
        <p><strong>No HP:</strong> {{ $user['phone_number'] }}</p>
    </div>

    <div class="checkout-card">
        <h5 class="mb-3">Rincian Obat</h5>

        @php $total = 0; @endphp

        @foreach ($drugs as $index => $drug)
            @php
                $item = $items[$index];
                $subtotal = $drug['price'] * $item['quantity'];
                $total += $subtotal;
            @endphp
            <div class="d-flex align-items-center mb-3">
                <img src="{{ asset('assets/images/obat/' . $drug['image']) }}" class="me-3 rounded" alt="{{ $drug['name'] }}">
                <div>
                    <h6 class="mb-1">{{ $drug['name'] }}</h6>
                    <small>Dosis: {{ $drug['dosis'] }}x sehari</small><br>
                    <small>Jumlah: {{ $item['quantity'] }} pcs</small><br>
                    <small class="text-muted">Rp {{ number_format($drug['price'], 0, ',', '.') }} / pcs</small>
                </div>
                <div class="ms-auto text-end">
                    <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                </div>
            </div>
        @endforeach

        <hr>
        <div class="total-section d-flex justify-content-between">
            <span>Total Bayar</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <!-- Form untuk Pemesanan -->
        <form action="{{ route('user.order') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-floating mb-3">
                <input id="rate" class="form-control" type="number" name="rate" value="">
                <label for="rate" class="form-label">Penilaian (dari 10)</label>
            </div>


            @foreach ($items as $index => $item)
                <input type="hidden" name="drugs[{{ $index }}][name]" value="{{ $item['name'] }}">
                <input type="hidden" name="drugs[{{ $index }}][duration_day]"
                    value="{{ $item['duration_day'] ?? 1 }}">
                <input type="hidden" name="amount[{{ $index }}]" value="{{ $item['quantity'] }}">
            @endforeach

            <button class="btn btn-red-general w-100 py-2">Bayar Sekarang</button>
        </form>
    </div>
@endsection
