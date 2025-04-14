@extends('layouts.app')

@section('title', 'Pengingat Minum Obat')
@section('back_button')


@section('header_title', 'Pengingat Minum Obat')

@section('content')
    <h4 class="text-center mt-3">Tambah Pengingat</h4>
    <br>

    <form action="{{ route('user.createReminder') }}" method="post">
        <div class="mb-3">
            <label for="namaObat" class="form-label">Nama Obat</label>
            <select name="reminder_id" class="form-select">
                @foreach ($reminders as $reminder)
                    <option value="{{ $reminder->id }}">{{ $reminder->drug->name }}</option>
                @endforeach
            </select>

        </div>

        @csrf
        <input type="hidden" name="time" id="timeInput" value="">

        <label class="form-label">Jadwal Minum <span class="fw-bold">1 x sehari</span></label>
        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-option w-25" onclick="selectTime('pagi', this)">Pagi 🌅</button>
            <button type="button" class="btn btn-option w-25" onclick="selectTime('siang', this)">Siang ☀️</button>
            <button type="button" class="btn btn-option w-25" onclick="selectTime('malam', this)">Malam 🌙</button>
        </div>

        <div class="form-floating mb-3">
            <input type="date" name="date" id="date" class="form-control">
            <label for="date">Tanggal</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Simpan</button>
    </form>

@endsection

@push('scripts')
    <script>
        function selectTime(value, element) {
            // Set value ke hidden input
            document.getElementById('timeInput').value = value;

            // Reset semua button
            document.querySelectorAll('.btn-option, .btn-selected').forEach(btn => {
                btn.classList.remove('btn-selected');
                btn.classList.add('btn-option');
            });

            // Tandai button yang diklik sebagai terpilih
            element.classList.remove('btn-option');
            element.classList.add('btn-selected');
        }
    </script>
@endpush
