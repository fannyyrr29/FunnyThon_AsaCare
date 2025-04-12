@extends('admins.app')

@section('title', 'Dashboard')

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                @if (session('header'))
                    <div class="alert alert-success">
                        <p><strong>{{ session('header') }}</strong> {{ session('message') }}</p>
                    </div>
                @elseif ($errors->has('header') && $errors->has('message'))
                    <div class="alert alert-danger">
                        <p><strong>{{ $errors->first('header') }}</strong> {{ $errors->first('message') }}</p>
                    </div>
                @endif
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <span class="input-group-append">
                            <form action="{{ route('admin.layanan.create') }}" method="get">
                                <button type="submit" class="btn btn-primary">+ Tambah</button>
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
                                <h3 class="card-title">Data Riwayat Kesehatan</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Jenis Layanan</th>
                                            <th>Harga</th>
                                            <th>Aksi Edit</th>
                                            <th>Aksi Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($actions as $action)
                                            <tr>
                                                <td>{{ $action->name }}</td>
                                                <td>{{ $action->description }}</td>
                                                <td>
                                                    <img src="{{ asset('assets/images/layanan/' . $action->image) }}"
                                                        alt="Image" width="50" height=auto data-bs-toggle="modal"
                                                        data-bs-target="#imageModal{{ $action->id }}"
                                                        style="cursor:pointer;">
                                                </td>

                                                <td>{{ $action->type }}</td>
                                                <td>{{ $action->price }}</td>
                                                <td>
                                                    <form action="{{ route('admin.layanan.edit', $action->id) }}"
                                                        method="get">@csrf <button class="btn btn-warning"
                                                            type="submit"><i class="fa fa-edit"></i></button></form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.layanan.destroy', $action->id) }}"
                                                        method="post">@csrf @method('DELETE') <button
                                                            class="btn btn-danger" type="submit"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach ($actions as $action)
                                            <!-- ... baris tabel ... -->

                                            <!-- Modal -->
                                            <div class="modal fade" id="imageModal{{ $action->id }}" tabindex="-1"
                                                aria-labelledby="imageModalLabel{{ $action->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="imageModalLabel{{ $action->id }}">
                                                                Preview Gambar</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset('assets/images/layanan/' . $action->image) }}"
                                                                alt="Gambar" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
