@extends('admins.app')

@section('title', 'Tambah Layanan')

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
        <div class="card mt-3">
            <h2 class="text-center mt-3">Ubah Layanan</h2>
            <div class="card-body">
                <form action="{{ route('admin.layanan.update', $action->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="nama" class="form-control"
                            value="{{ $action->name }}">
                        <label for="nama" class="form-label">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="description" id="description" cols="30" rows="20" class="form-control">{{ $action->description }}</textarea>
                        <label for="description" class="form-label">Deskripsi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                        <label for="image">Gambar</label>
                    </div>

                    @if (isset($action->image))
                        <div class="mb-3">
                            <label>Gambar Saat Ini:</label><br>
                            <img src="{{ asset('assets/images/layanan/' . $action->image) }}" alt="Gambar Lama"
                                width="150">
                            <input type="hidden" name="old_image" value="{{ $action->image }}">
                        </div>
                    @endif
                    <div class="form-floating mb-3">
                        <select name="type" id="type" class="form-select">
                            <option {{ $action->type === 'Homecare' ? 'selected' : '' }} value="Homecare">Perawatan Rumah
                            </option>
                            <option {{ $action->type === 'Hospitalcare' ? 'selected' : '' }} value="Hospitalcare">Perawatan
                                Rumah Sakit</option>
                        </select>
                        <label for="type">Tipe</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ $action->price }}">
                        <label for="price" class="form-label">Harga</label>
                    </div>
                    <input type="submit" value="UBAH" class="btn btn-danger w-100">
                </form>
            </div>
        </div>
    </div>
@endsection
