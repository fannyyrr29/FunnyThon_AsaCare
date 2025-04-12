@extends('layouts.app')

@section('title', 'Lengkapi Profil')
@section('header_title', 'Lengkapi Profil')
@section('back_button', true)

@section('content')
    <div class="card shadow" style="max-width: 400px; margin: auto; border-radius: 10px; padding: 20px;">
        <div class="card-body">
            <form action="{{ route('user.editProfile') }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="{{ $user->email }}" disabled>
                    <small class="text-danger" id="emailError"></small>
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik"
                        placeholder="Masukkan NIK" maxlength="16"
                        value="{{ $user->NIK ?? '' }}">
                    <small class="text-danger" id="nikError"></small>
                </div>
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        placeholder="Masukkan nama"
                        value="{{ $user->name ?? '' }}">
                    <small class="text-danger" id="namaError"></small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <div>
                        <input type="radio" class="form-check-input" name="gender" id="laki" value="L"
                            {{ $user->gender == 'L' || empty($user->gender) ? 'checked' : '' }}>
                        <label class="form-check-label me-3" for="laki">Laki - laki</label>
                
                        <input type="radio" class="form-check-input" name="gender" id="perempuan" value="P"
                            {{ $user->gender == 'P' ? 'checked' : '' }}>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                    <small class="text-danger" id="genderError"></small>
                </div>
                
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name = "tanggal_lahir" id="tanggal_lahir" value="{{$user->birthdate ?? \Carbon\Carbon::today()->format('Y-m-d')}}">
                    <small class="text-danger" id="tanggalLahirError"></small>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <div class="input-group">
                        <span class="input-group-text">+62</span>
                        <input type="tel" class="form-control" id="phone" name="phone"
                            placeholder="Masukkan nomor telepon"
                            value="{{ $user->phone_number ?? '' }}">
                    </div>
                    <small class="text-danger" id="phoneError"></small>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Rumah</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat rumah">{{ $user->address ?? '' }}</textarea>
                    <small class="text-danger" id="alamatError"></small>
                </div>

                <button type="submit" class="btn w-100 text-white fw-bold"
                    style="background-color: #a52a2a;">Simpan</button>
            </form>
        </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        document.getElementById("daftarForm").addEventListener("submit", function(event) {
            event.preventDefault();
            let isValid = true;

            let nik = document.getElementById("nik").value.trim();
            let nama = document.getElementById("nama").value.trim();
            let gender = document.querySelector('input[name="gender"]:checked');
            let tanggalLahir = document.getElementById("tanggal_lahir").value.trim();
            let phone = document.getElementById("phone").value.trim();
            let alamat = document.getElementById("alamat").value.trim();

            document.getElementById("nikError").innerText = "";
            document.getElementById("namaError").innerText = "";
            document.getElementById("genderError").innerText = "";
            document.getElementById("tanggalLahirError").innerText = "";
            document.getElementById("phoneError").innerText = "";
            document.getElementById("alamatError").innerText = "";

            if (nik === "" || nik.length !== 16 || isNaN(nik)) {
                document.getElementById("nikError").innerText = "NIK harus terdiri dari 16 angka!";
                isValid = false;
            }

            if (nama === "") {
                document.getElementById("namaError").innerText = "Nama tidak boleh kosong!";
                isValid = false;
            }

            if (!gender) {
                document.getElementById("genderError").innerText = "Pilih jenis kelamin!";
                isValid = false;
            }

            if (tanggalLahir === "") {
                document.getElementById("tanggalLahirError").innerText = "Pilih tanggal lahir!";
                isValid = false;
            }

            if (phone === "" || isNaN(phone) || phone.length < 10) {
                document.getElementById("phoneError").innerText = "Nomor telepon harus angka minimal 10 digit!";
                isValid = false;
            }

            if (alamat === "") {
                document.getElementById("alamatError").innerText = "Alamat rumah tidak boleh kosong!";
                isValid = false;
            }

            if (isValid) {
                alert("Pendaftaran berhasil!");
                this.submit();
            }
        });
    </script>
@endpush
