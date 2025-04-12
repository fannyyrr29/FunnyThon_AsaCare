@extends('admins.app')

@section('title', 'Ubah Obat')

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
            <h2 class="text-center mt-3">Ubah Obat</h2>
            <div class="card-body">
                <form action="{{ route('admin.obat.update', $drug->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="" class="form-control" required
                            value="{{ $drug->name }}">
                        <label class="form-label" for="name">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="price" id="price" class="form-control" required
                            value="{{ $drug->price }}">
                        <label class="form-label" for="price">Harga</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="quantity" id="quantity" class="form-control" required
                            value="{{ $drug->quantity }}">
                        <label class="form-label" for="quantity">Jumlah (biji)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="dosis" id="dosis" class="form-control" required
                            value="{{ $drug->dosis }}">
                        <label class="form-label" for="dosis">Dosis </label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="type" id="type" class="form-select">
                            <option {{ $drug->type === 'tablet' ? 'selected' : '' }} value="tablet">Tablet</option>
                            <option {{ $drug->type === 'sirup' ? 'selected' : '' }} value="sirup">Sirup</option>
                        </select>
                        <label class="form-label" for="type">Dosis</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="periode" id="periode" class="form-select">
                            <option {{ $drug->periode === 'Hari Tertentu' ? 'selected' : '' }} value="Hari Tertentu">Hari
                                Tertentu
                            </option>
                            <option {{ $drug->periode === 'Setiap Hari' ? 'selected' : '' }} value="Setiap Hari">Setiap
                                Hari</option>
                        </select>
                        <label class="form-label" for="periode">Periode</label>
                    </div>
                    <input class="btn btn-danger w-100" type="submit" value="UBAH">
                </form>
            </div>
        </div>
    </div>
@endsection
