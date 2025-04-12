@extends('admins.app')

@section('title', 'Dashboard')

@section('content')
    <main class="app-main">
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
                <div class="row">
                    <div class="col-sm-6">
                        <span class="input-group-append">
                            <form action="{{ route('admin.rumahsakit.create') }}" method="get">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus">
                                    </i>Tambah</button>
                            </form>
                        </span>
                    </div>
                </div>
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
                                            <th>Rumah Sakit</th>
                                            <th>Alamat</th>
                                            <th>Nomor Telepon</th>
                                            <th>Aksi UBAH</th>
                                            <th>Aksi Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hospitals as $hospital)
                                            <tr>
                                                <td>{{ $hospital->name }}</td>
                                                <td>{{ $hospital->address }}</td>
                                                <td>{{ $hospital->phone_number }}</td>
                                                <td>
                                                    <form action="{{ route('admin.rumahsakit.edit', $hospital->id) }}"
                                                        method="get">
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning">
                                                            <i class="fa fa-edit">
                                                            </i>
                                                        </button>
                                                    </form>

                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.rumahsakit.destroy', $hospital->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"> <i
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
