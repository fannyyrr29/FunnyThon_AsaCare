@extends('admins.app')

@section('title', 'Admin | Ubah Spesialisasi')

@section('content')
    @if (session('header') && session('message'))
        <div class="alert alert-success">
            <strong>{{ session('header') }}</strong><br>
            {{ session('message') }}
        </div>
    @elseif($errors->has('header') && $errors->has('message'))
        <div class="alert alert-danger">
            <strong>{{ $errors->first('header') }}</strong><br>
            {{ $errors->first('message') }}
        </div>
    @endif
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Ubah Spesialisasi</h1>
                <form action="{{ route('admin.spesialisasi.update', $specialization->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="" class="form-control"
                            value="{{ $specialization->name }}">
                        <label for="" class="form-label">Nama</label>
                    </div>
                    <input class="btn btn-danger w-100" type="submit" value="UBAH">
                </form>
            </div>
        </div>
    </div>
@endsection
