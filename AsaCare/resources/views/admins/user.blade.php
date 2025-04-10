@extends('admins.app')

@section('title', 'Dashboard')

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <span class="input-group-append">
                            <button type="button" class="btn btn-primary">+ Tambah</button>
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
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Alamat</th>
                                            <th>Nomor Telepon</th>
                                            <th>Role</th>
                                            <th>Gender</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Foto Profil</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->NIK }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->gender }}</td>
                                                <td>{{ $user->birthdate }}</td>
                                                <td><img src="{{ asset('assets/images/' . $user->profile) }}" alt="Image"
                                                        width="50" height=auto data-bs-toggle="modal" style="cursor:pointer;"></td>
                                                <td>{{ $user->email }}</td>
                                                <td><button type="button" class="btn btn-danger"><i
                                                            class="fa fa-trash"></i></button></td>
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
