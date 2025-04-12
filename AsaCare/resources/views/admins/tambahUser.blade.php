@extends('admins.app')
@section('title', 'Tambah User')


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
            <h2 class="text-center mt-3">Tambah Pengguna</h2>
            <div class="card-body">
                <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="nik" id="nik" class="form-control">
                        <label for="nik" class="form-label">NIK</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="name" class="form-control">
                        <label for="name" class="form-label">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="phone_number" id="phone_number" class="form-control">
                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="address" id="address" class="form-control">
                        <label for="address" class="form-label">Alamat</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="role" id="role" class="form-select">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                            <option value="Dokter">Dokter</option>
                        </select>
                        <label for="role" class="form-label">Peran</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="gender" id="gender" class="form-select">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" name="birthdate" id="birthdate" class="form-control">
                        <label for="birthdate" class="form-label">Tanggal Lahir</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="file" name="profile" id="profile" class="form-control" accept=".jpg, .png, .jpeg">
                        <label for="profile" class="form-label">Profil</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="email" id="email" class="form-control">
                        <label for="email" class="form-label">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" id="password" class="form-control">
                        <label for="password" class="form-label">Password</label>
                    </div>
                    <input type="submit" value="Tambah" class="btn btn-danger w-100">
                </form>
            </div>
        </div>
    </div>

@endsection
