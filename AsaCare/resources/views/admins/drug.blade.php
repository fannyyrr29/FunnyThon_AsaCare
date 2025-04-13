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
                <h3 class="mb-0">Obat</h3>
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <form class="d-flex justify-content-end mb-3" action="{{ route('admin.obat.create') }}" method="get">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-plus" aria-hidden="true"></i>
                        &nbsp;TAMBAH</button>
                </form>
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Quantity</th>
                        <th>Dosis</th>
                        <th>Tipe</th>
                        <th>Periode</th>
                        <th>Gambar</th>
                        <th>Ubah</th>
                        <th>Hapus</th>
                    </tr>
                    @foreach ($drugs as $drug)
                        <tr>
                            <td>{{ $drug->id }}</td>
                            <td>{{ $drug->name }}</td>
                            <td>{{ $drug->price }}</td>
                            <td>{{ $drug->quantity }}</td>
                            <td>{{ $drug->dosis }}</td>
                            <td>{{ $drug->type }}</td>
                            <td>{{ $drug->periode }}</td>
                            <td><img width="100px;" src="{{ asset('assets/images/obat/' . $drug->image) }}"
                                    alt="{{ $drug->name }}">
                            </td>
                            <td>
                                <form class="formEditSpesialisasi" method="GET"
                                    action="{{ route('admin.obat.edit', $drug->id) }}">
                                    <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                </form>
                            </td>
                            <td>
                                <form class="formHapusSpesialisasi" method="POST"
                                    action="{{ route('admin.obat.destroy', $drug->id) }}"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus obat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
@endsection
