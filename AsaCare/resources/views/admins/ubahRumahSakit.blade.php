@extends('admins.app')
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
    <div class="container mt-3">
        <h2 class="text-center">Ubah Rumah Sakit</h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.rumahsakit.update', $hospital->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="" value="{{ $hospital->name }}"
                            class="form-control">
                        <label for="na me" class="form-label">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="address" id="" value="{{ $hospital->address }}"
                            class="form-control">
                        <label for="na me" class="form-label">Alamat</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="phone_number" id="" value="{{ $hospital->phone_number }}"
                            class="form-control">
                        <label for="na me" class="form-label">Nomot Telepon</label>
                    </div>
                    <input type="submit" value="UBAH" class="btn btn-warning w-100">
                </form>
            </div>
        </div>
    </div>
@endsection
