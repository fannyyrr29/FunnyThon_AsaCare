@extends('layouts.app')

@section('title', 'Diagnosa')
@section('header_title', 'Diagnosa')
@section('back_button', true)

@section('content')
    <div class="py-3">
        <!-- Pasien -->
        <div class="mb-3">
            <label class="form-label fw-bold">Pasien</label>
            <select class="form-select">
                <option>Sri Haryati</option>
            </select>
        </div>

        <!-- Diagnosa -->
        <div class="mb-3">
            <label class="form-label fw-bold">Diagnosa</label>
            <textarea class="form-control" rows="4"></textarea>
        </div>

        <!-- Nama Obat -->
        <div class="mb-3">
            <label class="form-label fw-bold">Nama obat</label>
            <input type="text" class="form-control">
        </div>

        <!-- Dosis & Aturan -->
        <div class="p-3 border rounded mb-3 bg-white">
            <!-- Dosis -->
            <div class="mb-3">
                <label class="form-label fw-bold">Dosis</label>
                <div class="d-flex gap-2">
                    <input type="number" class="form-control text-center" style="width: 70px;" value="2">
                    <select class="form-select" style="width: 120px;">
                        <option>Pil</option>
                    </select>
                </div>
            </div>

            <!-- Periode -->
            <div class="mb-3">
                <label class="form-label fw-bold">Periode</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="periode" id="setiapHari" checked>
                    <label class="form-check-label" for="setiapHari">Setiap Hari</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="periode" id="hariTertentu" data-bs-toggle="modal"
                        data-bs-target="#modalHari">
                    <label class="form-check-label" for="hariTertentu">Hari Tertentu</label>
                </div>
            </div>

            <!-- Aturan Minum -->
            <div>
                <label class="form-label fw-bold">Aturan Minum</label>
                <div class="d-flex gap-2">
                    <input type="number" class="form-control text-center" style="width: 70px;" value="2">
                    <span class="align-self-center">x sehari</span>
                    <select class="form-select" style="flex: 1;">
                        <option>Sebelum makan</option>
                        <option>Sesudah makan</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Simpan Button -->
        <button class="btn w-100 text-white fw-bold" style="background-color: #A2191F; padding: 12px;">
            Simpan
        </button>
    </div>

    <!-- Modal Hari Tertentu -->
    <div class="modal fade" id="modalHari" tabindex="-1" aria-labelledby="modalHariLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHariLabel">Pilih Hari</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="senin"><label
                            class="form-check-label" for="senin">Senin</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="selasa"><label
                            class="form-check-label" for="selasa">Selasa</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="rabu"><label
                            class="form-check-label" for="rabu">Rabu</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="kamis"><label
                            class="form-check-label" for="kamis">Kamis</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="jumat"><label
                            class="form-check-label" for="jumat">Jumat</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="sabtu"><label
                            class="form-check-label" for="sabtu">Sabtu</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="minggu"><label
                            class="form-check-label" for="minggu">Minggu</label></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection