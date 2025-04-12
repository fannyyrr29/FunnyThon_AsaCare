@extends('admins.app')

@section('title', 'Dashboard')

@section('content')
    <main class="app-main mt-3">
        @if (session('header'))
            <div class="alert alert-success">
                <p><strong>{{ session('header') }}</strong> {{ session('message') }}</p>
            </div>
        @elseif ($errors->has('header') && $errors->has('message'))
            <div class="alert alert-danger">
                <p><strong>{{ $errors->first('header') }}</strong> {{ $errors->first('message') }}</p>
            </div>
        @endif
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <form action="{{ route('admin.dokter.create') }}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary">+ Tambah</button>
                </form>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <!-- Start col -->
                    <div class="connectedSortable">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Data Rumah Sakit</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Nomor Lisensi</th>
                                            <th>Pengalaman</th>
                                            <th>Rating</th>
                                            <th>Rumah Sakit</th>
                                            <th>Spesialisasi</th>
                                            <th>Aksi Ubah</th>
                                            <th>Aksi Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($doctors as $doctor)
                                            <tr>
                                                <td>{{ $doctor->name }}</td>
                                                <td>{{ $doctor->license_number }}</td>
                                                <td>{{ $doctor->experience_year }}</td>
                                                <td>{{ $doctor->rating }}</td>
                                                <td>{{ $doctor->hospital->name }}</td>
                                                <td>
                                                    {{ $doctor->specialization->name }}
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.dokter.edit', $doctor->id) }}"
                                                        method="get">
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning"><i
                                                                class="fa fa-edit"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.dokter.destroy', $doctor->id) }}"
                                                        method="post"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokter ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::App Content-->
    </main>
@endsection
