@extends('admins.app')

@section('title', 'Tambah Dokter')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mt-3">
        <h2 class="text-center mt-3">Tambah Dokter</h2>
        <div class="card-body">
            <form action="{{ route('admin.dokter.store') }}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="license_number" value="">
                    <label class="form-label" for="">Nomor Lisensi</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="name" id="name" class="form-control" value="">
                    <label class="form-label" for="name">Nama</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" name="experience_year" id="experience_year" class="form-control" value="">
                    <label class="form-label" for="experience_year">Pengalaman (Tahun)</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="hospital_id" id="" class="form-control">
                        @foreach ($hospitals as $hospital)
                            <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                        @endforeach
                    </select>
                    <label class="form-label" for="hospital">Rumah Sakit</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="specialization_id" id="hospital">
                        @foreach ($specializations as $specialization)
                            <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                        @endforeach
                    </select>
                    <label class="form-label" for="hospital">Spesialisasi</label>
                </div>
                <div class="form-group mb-3">
                    <label for="actions">Pengguna</label>
                    <select name="user_id" class="form-select">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="actions">Tindakan yang Bisa Dilakukan</label>
                    <select name="actions[]" class="form-select" id="actionSelect" multiple>
                        @foreach ($actions as $action)
                            <option value="{{ $action->id }}">
                                {{ $action->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="TAMBAH" class="w-100 btn btn-danger">
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#actionSelect').select2({
                placeholder: "Pilih tindakan",
                allowClear: true,
            });
        });
    </script>
@endsection
