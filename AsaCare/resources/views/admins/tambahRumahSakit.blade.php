@extends('admins.app')

@section('title', 'Tambah Rumah Sakit')

@section('content')
    <div class="container mt-3">
        @if (session('header'))
            <div class="alert alert-success">
                <p><strong>{{ session('header') }}</strong> {{ session('message') }}</p>
            </div>
        @elseif ($errors->has('header') && $errors->has('message'))
            <div class="alert alert-danger">
                <p><strong>{{ $errors->first('header') }}</strong> {{ $errors->first('message') }}</p>
            </div>
        @endif
        <div class="card">
            <h2 class="text-center mt-3">Tambah Rumah Sakit</h2>
            <div class="card-body">
                <form action="{{ route('admin.rumahsakit.store') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="" class="form-control" required>
                        <label class="form-label" for="name">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="address" id="" class="form-control" required>
                        <label class="form-label" for="name">Alamat</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="phone_number" id="" class="form-control" required>
                        <label class="form-label" for="name">Nomor Telepon</label>
                    </div>
                    <input class="btn btn-primary w-100" type="submit" value="TAMBAH">
                </form>
            </div>
        </div>
    </div>
@endsection
