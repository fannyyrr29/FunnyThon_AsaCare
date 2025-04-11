@extends('admins.app')

@section('title', 'Dashboard')

@section('content')
    <main class="app-main">

        @if (session('header'))
            @php
                $header = session('header') === 'SUKSES' ? 'success' : 'danger';
            @endphp
            <div class="alert alert-{{ $header }}">
                <p><strong>{{ session('header') }}</strong> {{ session('message') }}</p>
            </div>
        @endif

        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <h3 class="mb-0">Spesialisasi Dokter</h3>
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <form class="d-flex justify-content-end mb-3" action="{{ route('admin.spesialisasi.create') }}" method="get">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-plus" aria-hidden="true"></i>
                        &nbsp;TAMBAH</button>
                </form>
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Ubah</th>
                        <th>Hapus</th>
                    </tr>
                    @foreach ($specializations as $specialization)
                        <tr>
                            <td>{{ $specialization->id }}</td>
                            <td>{{ $specialization->name }}</td>
                            <td>
                                <form class="formEditSpesialisasi" method="GET"
                                    action="{{ route('admin.spesialisasi.edit', $specialization->id) }}">
                                    <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                </form>
                            </td>
                            <td>
                                <form class="formHapusSpesialisasi" method="POST"
                                    action="{{ route('admin.spesialisasi.destroy', $specialization->id) }}">
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
