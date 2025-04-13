@extends('layouts.app')

@section('title', 'Riwayat Obat')

@section('header_title', 'Riwayat Beli Obat')

@section('content')
    <div class="container mt-3">
        @foreach ($history as $item)
            <div class="card-custom">
                <p>{{ $item->created_at->translatedFormat('d F Y') }}
                </p>
                <h5>{{ $item->user->address }}</h5>
                <ul>
                    @foreach ($item->drugRecords as $drugRecord)
                        <li>{{ $drugRecord->drug->name }} - Rp{{ number_format($drugRecord->subtotal, 0, ',', '.') }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection
