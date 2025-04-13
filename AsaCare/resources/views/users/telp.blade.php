@extends('layouts.app')

@section('title', 'Kontak Darurat')
@section('header_title', 'Telepon')
@section('back_button', true)

@section('content')
    @foreach ($emergencycalls as $emergencycall)
        <div class="contact-card">
            <div>
                <h5>{{ $emergencycall->name }}</h5>
                <p class="text-muted">{{$emergencycall->phone_number}}</p>
            </div>
            <div class="contact-icon">
                <a href="tel:{{ $emergencycall->phone_number }}">
                    <img src="{{ asset('assets/images/telp.png') }}" alt="Telepon">
                </a>
            </div>
        </div>
    @endforeach

    <button class="add-button" data-bs-toggle="modal" data-bs-target="#addPhoneModal">
        <i class="fas fa-plus"></i>
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="addPhoneModal" tabindex="-1" aria-labelledby="addPhoneModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('user.emergencyCall.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPhoneModalLabel">Tambah Kontak Darurat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Nomor Telepon</label>
                            <input type="tel" name="phone_number" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection