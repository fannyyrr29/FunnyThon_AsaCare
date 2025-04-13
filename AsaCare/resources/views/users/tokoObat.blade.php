@extends('layouts.app')

@section('title', 'Toko Obat')
@section('header_title', 'Toko Obat')
@section('back_button', true)

@push('styles')
    <style>
        .product-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .btn-red-general {
            background-color: #A6192E;
            color: white;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-red-general:hover {
            background-color: #8b1624;
        }

        .cart {
            background-color: #A6192E;
            color: black;
            border-radius: 8px;
            padding: 1rem;
        }

        #cart-items-container {
            max-height: 300px;
            overflow-y: auto;
            padding: 0.5rem;
        }

        #cart-items {
            font-size: 14px;
        }

        #total {
            font-size: 18px;
            font-weight: bold;
        }

        #cart-items li {
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        #cart-items li:last-child {
            border-bottom: none;
        }
    </style>
@endpush

@section('content')
    @if (session('header'))
        <div class="alert alert-success">
            <p><strong>{{ session('header') }}</strong> {{ session('message') }}</p>
        </div>
    @elseif ($errors->has('header') && $errors->has('message'))
        <div class="alert alert-danger">
            <p><strong>{{ $errors->first('header') }}</strong> {{ $errors->first('message') }}</p>
        </div>
    @endif
    <div class="search-bar">
        <input type="text" placeholder="Cari disini">
        <i class="fas fa-search"></i>
    </div>

    <div class="row g-3">
        @foreach ($drugs as $drug)
            <div class="col-6">
                <div class="product-card text-center">
                    <img src="{{ asset('assets/images/obat/' . $drug->image) }}" class="rounded d-block mx-auto"
                        alt="...">
                    <h6>{{ $drug->name }}</h6>
                    <strong>{{ $drug->price }}</strong>
                    <div>
                        <button class="btn-red-general py-2 px-4 tambah" data-name="{{ $drug->name }}"
                            data-price="{{ $drug->price }}" data-id={{ $drug->id }}>
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row cart w-100 mt-4" style="background-color: #A6192E; padding: 1rem; border-radius: 8px;">
        <div class="col-12">
            <form action="{{ route('user.checkout') }}" method="get" id="checkout-form">
                @csrf
                <h5 id="total" class="text-white font-weight-bold mb-2">Total: Rp 0</h5>
                <div id="cart-items-container" class="bg-white p-3 rounded shadow-sm">
                    <ul id="cart-items" class="list-unstyled mb-0"></ul>
                </div>
                <input type="hidden" name="items" id="cart-items-input">
                <input type="submit" value="BAYAR" class="btn w-100 mt-3" style="background-color: #fdf6ec;">
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let total = 0;
        let cartItems = [];

        $('.tambah').click(function(e) {
            e.preventDefault();
            const drugId = $(this).data('id');
            const drugName = $(this).data('name');
            const drugPrice = Number($(this).data('price'));


            const existingIndex = cartItems.findIndex(item => item.name === drugName);

            if (existingIndex !== -1) {
                cartItems[existingIndex].quantity += 1;
            } else {
                cartItems.push({
                    id: drugId,
                    name: drugName,
                    price: drugPrice,
                    quantity: 1
                });
            }

            total = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            $('#total').text("Total: Rp " + total.toLocaleString('id-ID'));

            renderCartItems();
        });

        function renderCartItems() {
            let itemList = '';
            cartItems.forEach(function(item, index) {
                itemList += `
            <li class="cart-item d-flex justify-content-between align-items-center">
                <span>${item.name} - Rp ${item.price.toLocaleString('id-ID')}</span>
                <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-outline-danger adjust-quantity" data-index="${index}" data-action="decrease">-</button>
                    <span class="mx-2">${item.quantity}</span>
                    <button class="btn btn-sm btn-outline-danger adjust-quantity" data-index="${index}" data-action="increase">+</button>
                    <button class="btn btn-sm btn-danger remove-item" data-index="${index}">Hapus</button>
                </div>
            </li>
        `;
            });

            $('#cart-items').html(itemList);
        }

        $(document).on('click', '.adjust-quantity', function() {
            const index = $(this).data('index');
            const action = $(this).data('action');

            if (action === 'increase') {
                cartItems[index].quantity += 1;
            } else if (action === 'decrease' && cartItems[index].quantity > 1) {
                cartItems[index].quantity -= 1;
            }

            // Jika quantity menjadi 0, hapus item
            if (cartItems[index].quantity === 0) {
                cartItems.splice(index, 1);
            }

            total = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            $('#total').text("Total: Rp " + total.toLocaleString('id-ID'));

            renderCartItems();
        });



        $(document).on('click', '.remove-item', function() {
            const index = $(this).data('index');

            total -= cartItems[index].price * cartItems[index].quantity;

            cartItems.splice(index, 1);

            $('#total').text("Total: Rp " + total.toLocaleString('id-ID'));
            renderCartItems();
        });


        $('#checkout-form').submit(function(e) {
            if (cartItems.length === 0) {
                e.preventDefault();
                alert('Keranjang belanja Anda kosong. Silakan tambahkan produk terlebih dahulu.');
                return false;
            }
            const itemsJson = JSON.stringify(cartItems);
            $('#cart-items-input').val(itemsJson);
        });
    </script>
@endpush
