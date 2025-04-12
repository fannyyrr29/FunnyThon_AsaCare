@extends('admins.app')

@section('title', 'Ubah Riwayat Kesehatan')


@section('content')
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

        <div class="card mt-3">
            <div class="card-body">
                <h1 class="text-center">Ubah Riwayat Kesehatan</h1>
                <form action="{{ route('admin.riwayatKesehatan.update', $medicalRecord->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control w-100" type="text" name="diagnosa" id="diagnosa" required
                            placeholder="Tuliskan diagnosa di sini" value="{{ $medicalRecord->diagnose }}">
                        <label class="form-label" for="diagnosa">Diagnosa</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10"
                            placeholder="Tuliskan deskripsi di sini" required>{{ $medicalRecord->description }}</textarea>
                        <label class="form-label" for="deskripsi">Description</label>
                    </div>
                    <div class="form floating mb-3">
                        <label for="">Pilih Dokter</label>
                        <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="doctor_id"
                            required>
                            <option value="" selected disabled>Pilih Pengguna</option>
                            @foreach ($allDoctors as $doctor)
                                <option value="{{ $doctor->id }}"
                                    {{ $doctor->id == $medicalRecord->doctor_id ? 'selected' : '' }}>
                                    {{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form floating mb-3">
                        <label for="">Pilih Pengguna</label>
                        <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="user_id"
                            required>
                            <option value="" selected disabled>Pilih Pengguna</option>
                            @foreach ($allUsers as $user)
                                <option value="{{ $user->id }}"
                                    {{ $user->id == $medicalRecord->user_id ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Pilih Layanan (Multiple dengan Select2) -->
                    <div class="mb-3">
                        <label for="actionSelect">Pilih Layanan</label>
                        <select class="form-select" id="actionSelect" name="action_ids[]" multiple required>
                            @foreach ($allActions as $action)
                                <option value="{{ $action->id }}" @if ($medicalRecord->actions->contains('id', $action->id)) selected @endif>
                                    {{ $action->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Obat (Multiple dengan Select2) -->
                    <div class="form-group mb-3">
                        <label for="drugSelect">Obat</label>
                        <select class="form-select" id="drugSelect" name="drug_ids[]" multiple required>
                            @foreach ($allDrugs as $drug)
                                <option value="{{ $drug->id }}" data-name="{{ $drug->name }}"
                                    @if ($medicalRecord->drugRecords->contains('drug_id', $drug->id)) selected @endif>
                                    {{ $drug->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="selectedDrugsContainer">
                        @foreach ($medicalRecord->drugRecords as $record)
                            @php
                                $drug = $record->drug;
                                $reminder = $medicalRecord->reminders->firstWhere('drug_id', $record->drug_id);
                                $duration = $reminder ? $reminder->duration_day : 1; // fallback 1 kalau tidak ada
                            @endphp

                            <div class="card p-3 mb-2 border rounded">
                                <h5>{{ $drug ? $drug->name : 'Obat tidak ditemukan' }}</h5>

                                <input type="hidden" name="drugs[{{ $record->drug_id }}][id]"
                                    value="{{ $record->drug_id }}">

                                <div class="form-group mb-2">
                                    <label>Jumlah (amount)</label>
                                    <input type="number" name="drugs[{{ $record->drug_id }}][amount]" class="form-control"
                                        required min="1" value="{{ $record->amount }}">
                                </div>

                                <div class="form-group mb-2">
                                    <label>Lama Hari (duration_day)</label>
                                    <input type="number" name="drugs[{{ $record->drug_id }}][duration_day]"
                                        class="form-control" required min="1" value="{{ $duration }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="submit" value="UBAH" class="btn btn-danger w-100">
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            console.log("jQuery is working");

            $('#actionSelect').select2({
                placeholder: 'Pilih Layanan',
                allowClear: true
            })


            let $select = $('#drugSelect');
            if ($select.length) {
                console.log("Select2 element found:", $select);
                $select.select2({
                    placeholder: 'Pilih Obat',
                    allowClear: true,
                    minimumResultsForSearch: 0
                });

            } else {
                console.warn("Select2 element NOT FOUND!");
            }


            $('#drugSelect').on('change', function() {
                let selectedDrugs = $(this).val();
                let container = $('#selectedDrugsContainer');
                container.empty(); // Kosongkan dulu

                if (selectedDrugs.length > 0) {
                    selectedDrugs.forEach(function(drugId) {
                        let drugName = $('#drugSelect option[value="' + drugId + '"]').data('name');

                        let html = `
                        <div class="card p-3 mb-2 border rounded">
                            <h5>${drugName}</h5>
                            <input type="hidden" name="drugs[${drugId}][id]" value="${drugId}">
                            <div class="form-group mb-2">
                                <label>Jumlah (amount)</label>
                                <input type="number" name="drugs[${drugId}][amount]" class="form-control" required min="1" value="1">
                            </div>
                            <div class="form-group mb-2">
                                <label>Lama Hari (duration_day)</label>
                                <input type="number" name="drugs[${drugId}][duration_day]" class="form-control" required min="1" value="1">
                            </div>
                        </div>
                    `;

                        container.append(html);
                    });
                }
            });
        });
    </script>
@endsection
