@extends('layouts.app')

@section('title', 'Pengingat Minum Obat')
@section('back_button', true)


@section('header_title', 'Pengingat Minum Obat')

@section('content')
    <h4 class="text-center mt-3">Tambah Pengingat</h4>
    <br>

    <div class="mb-3">
        <label for="namaObat" class="form-label">Nama Obat</label>
        <select id="namaObat" class="form-select">
            <option>Pilih Obat</option>
            <option>Paracetamol</option>
            <option>Amoxicillin</option>
            <option>Ibuprofen</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Jadwal Minum <span class="fw-bold">1 x sehari</span></label>
        <div class="d-flex justify-content-between">
            <button class="btn btn-selected w-25">Pagi 🌅</button>
            <button class="btn btn-option w-25">Siang ☀️</button>
            <button class="btn btn-option w-25">Malam 🌙</button>
        </div>
    </div>

    <button class="btn btn-primary w-100">Simpan</button>
@endsection