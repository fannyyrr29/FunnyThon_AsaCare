@extends('admins.app')

@section('title', 'Dashboard')

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
            <div class="card-body">
                <h2 class="text-center">Tambah Spesialisasi</h2>
                <form action="{{ route('admin.spesialisasi.store') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control nama-spesialisasi" type="text" name="name" id="nama">
                        <label for="nama">Nama</label>
                    </div>
                    <input type="submit" value="TAMBAH" class="btn btn-danger w-100 btnHapus">
                </form>
            </div>
        </div>
    </div>
@endsection
