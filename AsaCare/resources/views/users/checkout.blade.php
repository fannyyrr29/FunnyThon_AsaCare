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

    <div class="header">
        <i class="fas fa-store"></i>
        <span>Ringkasan Pembayaran</span>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <h5>Nama: {{ $user['name'] }}</h5>
                <h6 class="fw-bold">Alamat Pengantaran</h6>
                <div class="d-flex justify-content-between">
                    <span><i class="bi bi-geo-alt-fill"></i>{{ $user['address'] }}</span>
                </div>
                <p>{{ $user['phone_number'] }}</p>
            </div>
            <hr>
            @php
                $total = 0;
            @endphp

            @foreach ($drugs as $index => $drug)
                @php
                    $item = $items[$index];
                    $subtotal = $drug['price'] * $item['quantity'];
                    $total += $subtotal;
                @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>{{ $drug['name'] }}</h6>
                            <span class="text-danger">Rp. {{ number_format($drug['price'], 0, ',', '.') }}</span>
                        </div>
                        <div class="input-group quantity-group" style="width: 100px;">
                            <button type="button" class="btn btn-outline-danger btn-sm btn-minus"
                                data-index="{{ $index }}">-</button>
                            <input type="text" class="form-control text-center quantity-input"
                                name="items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}" readonly
                                data-index="{{ $index }}" data-price="{{ $drug['price'] }}">
                            <button type="button" class="btn btn-outline-danger btn-sm btn-plus"
                                data-index="{{ $index }}">+</button>
                        </div>
                    </div>
                    <div class="text-end">
                        <small>Subtotal: <span class="subtotal" data-index="{{ $index }}">Rp
                                {{ number_format($subtotal, 0, ',', '.') }}</span></small>
                    </div>
                </div>
                <hr>
            @endforeach
            @php
                $biayaPengiriman = $total > 100000 ? 0 : ($total > 50000 ? 3000 : 5000);

            @endphp
            <div>
                <h6>Rincian Pembayaran</h6>
                <div class="d-flex justify-content-between">
                    <span>Harga</span>
                    <span id="totalHarga">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Biaya Pengiriman</span>
                    <span id="biayaPengiriman">Rp {{ number_format($biayaPengiriman, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between fw-bold mt-2">
                    <span>Total Pembayaran</span>
                    <span id="totalPembayaran">Rp {{ number_format($total + $biayaPengiriman, 0, ',', '.') }}</span>
                </div>
            </div>
            <hr>
            <div>
                <h5 class="text-left" class="fw-bold">Bayar Tunai</h5>
                <h5 class="text-right" class="fw-bold" id="totalBayar">
                    {{ number_format($total + $biayaPengiriman, 0, ',', '.') }}</h5>
                <form action="{{ route('user.order') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="form-floating mb-3">
                        <input id="rate" class="form-control" type="number" name="rate" value="" required>
                        <label for="rate" class="form-label">Penilaian (dari 10)</label>
                    </div>


                    @foreach ($items as $index => $item)
                        <input type="hidden" name="drugs[{{ $index }}][id]" value="{{ $drug['id'] }}">
                        <input type="hidden" name="drugs[{{ $index }}][duration_day]"
                            value="{{ $item['duration_day'] ?? 1 }}">
                        <input type="hidden" name="amount[{{ $index }}]" value="{{ $item['quantity'] }}">
                    @endforeach
                    <input type="hidden" name="ongkir" value="{{ $biayaPengiriman }}">
                    <button type="submit" class="btn btn-red-general w-100 py-2">Bayar Sekarang</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-plus, .btn-minus').on('click', function() {
                let index = $(this).data('index');
                let $input = $('.quantity-input[data-index="' + index + '"]');
                let currentVal = parseInt($input.val()) || 0;
                let price = parseInt($input.data('price')) || 0;

                if ($(this).hasClass('btn-plus')) {
                    $input.val(currentVal + 1);
                } else if (currentVal > 1) {
                    $input.val(currentVal - 1);
                }

                let newVal = parseInt($input.val());
                let newSubtotal = price * newVal;
                $('.subtotal[data-index="' + index + '"]').text("Rp " + formatRupiah(newSubtotal));
                $('input[name="amount[' + index + ']"]').val(newVal);

                updateTotal();
            });

            function updateTotal() {
                let total = 0;

                $('.quantity-input').each(function() {
                    let quantity = parseInt($(this).val()) || 0;
                    let price = parseInt($(this).data('price')) || 0;
                    total += quantity * price;
                });

                let biayaPengiriman = 0;
                if (total > 100000) biayaPengiriman = 0;
                else if (total > 50000) biayaPengiriman = 3000;
                else biayaPengiriman = 5000;

                $('#totalHarga').text('Rp ' + formatRupiah(total));
                $('#biayaPengiriman').text('Rp ' + formatRupiah(biayaPengiriman));
                $('#totalPembayaran').text('Rp ' + formatRupiah(total + biayaPengiriman));
                $('#totalBayar').text('Rp ' + formatRupiah(total + biayaPengiriman));
            }

            function formatRupiah(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });
    </script>
@endpush
