@extends('admins.app')

@section('title', 'Tambah Layanan')

@section('content')
    <div class="container">
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
            <h2 class="text-center mt-3">Tambah Layanan</h2>
            <div class="card-body">
                <form action="{{ route('admin.layanan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="nama" class="form-control">
                        <label for="nama" class="form-label">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="description" id="description" cols="30" rows="20" class="form-control"></textarea>
                        <label for="description" class="form-label">Deskripsi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                        <label for="image">Gambar</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="type" id="type" class="form-select">
                            <option value="Homecare">Perawatan Rumah</option>
                            <option value="Hospitalcare">Perawatan Rumah Sakit</option>
                        </select>
                        <label for="type">Tipe</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="price" id="price" class="form-control">
                        <label for="price" class="form-label">Harga</label>
                    </div>
                    <input type="submit" value="TAMBAH" class="btn btn-danger w-100">
                </form>
            </div>
        </div>
    </div>
@endsection
