@extends('layouts.doctorApp')

@section('PageName', 'Tambah Riwayat Kesehatan')

@section('content')
    <div class="container-fluid">
        @if (session('header') && session('message'))
            @php
                $alertType = session('header') === 'SUKSES' ? 'success' : 'danger';
            @endphp
            <div class="alert alert-{{ $alertType }} alert-dismissible fade show mt-3" role="alert">
                <strong>{{ session('header') }}:</strong> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Tambah Riwayat Kesehatan</h1>
                <form action="{{ route('medicalRecord.store') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control w-100" type="text" name="diagnosa" id="diagnosa"
                            placeholder="Tuliskan diagnosa di sini">
                        <label class="form-label" for="diagnosa">Diagnosa</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10"
                            placeholder="Tuliskan deskripsi di sini"></textarea>
                        <label class="form-label" for="deskripsi">Description</label>
                    </div>
                    <div class="form floating mb-3">
                        <label for="">Pilih Pengguna</label>
                        <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="user_id">
                            <option value="" selected disabled>Pilih Pengguna</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label for="id_label_multiple">Layanan</label>
                        <select class="form-control js-example-basic-multiple" id="actionSelect" multiple="multiple"
                            style="width:100%" name="action_ids[]">
                            @foreach ($actions as $action)
                                <option value="{{ $action->id }}">{{ $action->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label for="id_label_multiple">Obat</label>
                        <select class="form-control js-example-basic-multiple" id="drugSelect" multiple="multiple"
                            style="width:100%" name="drug_ids[]">
                            @foreach ($drugs as $drug)
                                <option value="{{ $drug->id }}" data-name="{{ $drug->name }}">{{ $drug->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div id="selectedDrugsContainer"></div>
                    <input type="submit" value="SUBMIT" class="btn btn-danger w-100">
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            console.log("jQuery is working");

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

            $('#actionSelect').select2({
                placeholder: 'Pilih Layanan',
                allowClear: true
            })


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
