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
                                <h3 class="card-title">Data Riwayat Kesehatan</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pasien</th>
                                            <th>Dokter</th>
                                            <th>Diagnosa</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal</th>
                                            <th>Rating</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($medicalRecords as $medicalRecord)
                                            <tr>
                                                <td>{{ $medicalRecord->user->name }}</td>
                                                <td>{{ $medicalRecord->doctor->name }}</td>
                                                <td>{{ $medicalRecord->diagnose }}</td>
                                                <td>{{ $medicalRecord->description }}</td>
                                                <td>{{ $medicalRecord->date }}</td>
                                                <td>{{ $medicalRecord->rating }}</td>
                                                <td>{{ $medicalRecord->total }}</td>
                                                <td><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                            </tr>
                                        @endforeach
                                        {{-- {{ $medicalRecords }} --}}
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