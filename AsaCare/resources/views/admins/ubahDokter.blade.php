@extends('admins.app')

@section('title', 'Ubah Dokter')

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
        <h2 class="text-center mt-3">Ubah Dokter</h2>
        <div class="card-body">
            <form action="{{ route('admin.dokter.update', $doctor->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="license_number" value="{{ $doctor->license_number }}">
                    <label class="form-label" for="">Nomor Lisensi</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="name" id="name" class="form-control" value="{{ $doctor->name }}">
                    <label class="form-label" for="name">Nama</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="rating" id="rating" class="form-control" value="{{ $doctor->rating }}"
                        readonly>
                    <label class="form-label" for="license_number">Rating</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" name="experience_year" id="experience_year" class="form-control"
                        value="{{ $doctor->experience_year }}">
                    <label class="form-label" for="experience_year">Pengalaman (Tahun)</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="specialization_id" id="specialization">
                        @foreach ($specializations as $specialization)
                            <option value="{{ $specialization->id }}"
                                {{ $doctor->specialization->id == $specialization->id ? 'selected' : '' }}>
                                {{ $specialization->name }}
                            </option>
                        @endforeach
                    </select>
                    <label class="form-label" for="specialization">Spesialisasi</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="hospital_id" id="hospital">
                        @foreach ($hospitals as $hospital)
                            <option value="{{ $hospital->id }}"
                                {{ $doctor->hospital->id == $hospital->id ? 'selected' : '' }}>
                                {{ $hospital->name }}
                            </option>
                        @endforeach
                    </select>
                    <label class="form-label" for="hospital">Rumah Sakit</label>
                </div>
                <div class="form-group mb-3">
                    <label for="actions">Tindakan yang Bisa Dilakukan</label>
                    <select name="actions[]" class="form-select" id="actionSelect" multiple>
                        @foreach ($actions as $action)
                            <option value="{{ $action->id }}"
                                {{ $doctor->actions->contains('id', $action->id) ? 'selected' : '' }}>
                                {{ $action->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="UBAH" class="w-100 btn btn-danger">
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
