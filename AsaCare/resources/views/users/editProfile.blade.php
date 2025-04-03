<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f1dc;
        }

        .card {
            max-width: 400px;
            margin: auto;
            border-radius: 10px;
            padding: 20px;
        }

        .card-header {
            background-color: #a52a2a;
            color: white;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }

        .btn-masuk {
            background-color: #a52a2a;
            color: white;
            font-weight: bold;
            width: 100%;
        }

        .btn-masuk:hover {
            background-color: #8b1e1e;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header">Daftar Akun</div>
            <div class="card-body">
                <form id="daftarForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukkan email">
                        <small class="text-danger" id="emailError"></small>
                    </div>

                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" placeholder="Masukkan NIK" maxlength="16">
                        <small class="text-danger" id="nikError"></small>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukkan nama">
                        <small class="text-danger" id="namaError"></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div>
                            <input type="radio" class="form-check-input" name="gender" id="laki" value="Laki-laki">
                            <label class="form-check-label me-3" for="laki">Laki - laki</label>
                            <input type="radio" class="form-check-input" name="gender" id="perempuan" value="Perempuan">
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                        <small class="text-danger" id="genderError"></small>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir">
                        <small class="text-danger" id="tanggalLahirError"></small>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text">+62</span>
                            <input type="tel" class="form-control" id="phone" placeholder="Masukkan nomor telepon">
                        </div>
                        <small class="text-danger" id="phoneError"></small>
                    </div>

                    <button type="submit" class="btn btn-masuk">Daftar</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
        document.getElementById("daftarForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Mencegah form terkirim sebelum validasi selesai
            let isValid = true;

            let email = document.getElementById("email").value.trim();
            let nik = document.getElementById("nik").value.trim();
            let nama = document.getElementById("nama").value.trim();
            let gender = document.querySelector('input[name="gender"]:checked');
            let tanggalLahir = document.getElementById("tanggal_lahir").value.trim();
            let phone = document.getElementById("phone").value.trim();

            document.getElementById("emailError").innerText = "";
            document.getElementById("nikError").innerText = "";
            document.getElementById("namaError").innerText = "";
            document.getElementById("genderError").innerText = "";
            document.getElementById("tanggalLahirError").innerText = "";
            document.getElementById("phoneError").innerText = "";

            if (email === "" || !email.includes("@") || !email.includes(".")) {
                document.getElementById("emailError").innerText = "Email tidak valid!";
                isValid = false;
            }

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

            if (isValid) {
                alert("Pendaftaran berhasil!");
                this.submit();
            }
        });

    </script>
</body>

</html>