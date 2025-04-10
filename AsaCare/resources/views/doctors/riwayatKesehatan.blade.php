@extends('layouts.doctorApp')

@section('content')
    @if (session('header') && session('message'))
        @php
            $alertType = session('header') === 'SUKSES' ? 'success' : 'danger';
        @endphp
        <div class="mb-3 alert alert-{{ $alertType }} alert-dismissible fade show" role="alert">
            <strong>{{ session('header') }}:</strong> {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <h1 class="text-center my-3">Data Riwayat Kesehatan User</h1>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Diagnosa</th>
                        <th>Deskripsi</th>
                        <th>Date</th>
                        <th>Rating</th>
                        <th>Dokter</th>
                        <th>User</th>
                        <th>Riwayat Obat</th>
                        <th>Riwayat Pengingat</th>
                        <th>Riwayat Layanan</th>
                        <th>Ubah</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medicalRecords as $medicalRecord)
                        <tr>
                            <td>{{ $medicalRecord->diagnose }}</td>
                            <td>{{ $medicalRecord->description }}</td>
                            <td>{{ date('d-m-Y', strtotime($medicalRecord->date)) }}</td>
                            <td>{{ $medicalRecord->rating }}</td>
                            <td>{{ $medicalRecord->doctor->name }}</td>
                            <td>{{ $medicalRecord->user->name }}</td>
                            <td><button data-id="{{ $medicalRecord->id }}" class="btn btn-primary tampilObat">Tampilkan
                                    Obat</button></td>
                            <td><button data-id="{{ $medicalRecord->id }}" class="btn btn-danger tampilPengingat">Tampilkan
                                    Pengingat</button></td>
                            <td><button data-id="{{ $medicalRecord->id }}" class="btn btn-secondary tampilAction">Tampilkan
                                    Layanan</button></td>
                            <td>
                                <form action="" method="post">
                                    @csrf
                                    <input class="btn btn-warning" type="submit" value="Ubah">
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('medicalRecord.destroy', $medicalRecord->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input class="btn btn-danger btnHapus" type="submit" value="Hapus">
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="{{ route('medicalRecord.create') }}" method="get">
                <button type="submit" class="btn btn-success">Tambah</button>
            </form>
            <div class="modal fade" id="drugModal" tabindex="-1" aria-labelledby="drugModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="drugModalLabel">Daftar Obat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Obat</th>
                                        <th>Jenis</th>
                                        <th>Dosis</th>
                                        <th>Periode</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="drugTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="reminderModal" tabindex="-1" aria-labelledby="reminderModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reminderModalLabel">Daftar Obat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Obat</th>
                                        <th>Jam</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="reminderTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Riwayat Aksi pada Medical Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group" id="actionList">
                                <!-- Diisi dari JavaScript -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            const medicalRecords = @json($medicalRecords);
            $('.tampilObat').click(function(e) {
                e.preventDefault();
                console.log('Tombol diklik'); // HARUS muncul di console

                const recordId = $(this).data('id');
                const record = medicalRecords.find(r => r.id === recordId);

                $('#drugTableBody').empty();

                if (record && record.drug_records.length > 0) {
                    record.drug_records.forEach(dr => {
                        const drug = dr.drug;
                        $('#drugTableBody').append(`
                    <tr>
                        <td>${drug.name}</td>
                        <td>${drug.type}</td>
                        <td>${drug.dosis}</td>
                        <td>${drug.periode}</td>
                        <td>${dr.amount}</td>
                        <td>Rp ${dr.subtotal.toLocaleString()}</td>
                    </tr>
                `);
                    });
                } else {
                    $('#drugTableBody').append(`
                <tr>
                    <td colspan="6" class="text-center text-danger">Tidak ada obat untuk riwayat ini.</td>
                </tr>
            `);
                }

                $('#drugModal').modal('show');

            });

            $('.tampilPengingat').click(function(e) {
                e.preventDefault();
                const recordId = $(this).data('id');
                const record = medicalRecords.find(r => r.id === recordId);

                $('#reminderTableBody').empty();

                if (record && record.reminders.length > 0) {
                    record.reminders.forEach(reminder => {
                        const drug = record.drug_records.find(dr => dr.drug_id === reminder.drug_id)
                            ?.drug;
                        const drugName = drug ? drug.name : '-';

                        if (reminder.reminder_times && reminder.reminder_times.length > 0) {
                            reminder.reminder_times.forEach(rt => {
                                let formattedDate = rt.date;
                                if (rt.date && rt.date.includes('-')) {
                                    const [year, month, day] = rt.date.split('-');
                                    formattedDate = `${day}-${month}-${year}`;
                                }

                                const reminderTime = rt.time.time;
                                const status = rt.status == 1 ? 'Belum Diminum' :
                                    'Sudah Diminum';

                                $('#reminderTableBody').append(`
                                    <tr>
                                        <td>${formattedDate}</td>
                                        <td>${drugName}</td>
                                        <td>${reminderTime}</td>
                                        <td>${status}</td>
                                    </tr>
                                `);
                            });
                        } else {
                            $('#reminderTableBody').append(`
                            <tr>
                                <td colspan="4" class="text-center text-warning">
                                    Pengingat untuk obat <strong>${drugName}</strong> belum memiliki waktu minum.
                                </td>
                            </tr>
                        `);
                        }
                    });

                } else {
                    $('#reminderTableBody').append(`
            <tr>
                <td colspan="4" class="text-center text-danger">Tidak ada pengingat untuk riwayat ini.</td>
            </tr>
        `);
                }

                $('#reminderModal').modal('show');
            });
            $('.tampilAction').click(function(e) {
                e.preventDefault();
                const recordId = $(this).data('id');
                const record = medicalRecords.find(r => r.id === recordId);

                $('#actionList').empty();

                if (record && record.actions && record.actions.length > 0) {
                    record.actions.forEach(act => {
                        const date = new Date(act.created_at);
                        const formatted = `${date.getDate().toString().padStart(2, '0')}-${(date.getMonth() + 1)
                .toString().padStart(2, '0')}-${date.getFullYear()}`;

                        $('#actionList').append(`
                <li class="list-group-item">
                    <strong>[${formatted}]</strong> - ${act.type.toUpperCase()}: ${act.description}
                </li>
            `);
                    });
                } else {
                    $('#actionList').append(`
            <li class="list-group-item text-center text-muted">
                Belum ada aksi yang tercatat untuk medical record ini.
            </li>
        `);
                }

                $('#actionModal').modal('show');
            });

        });

        $('.btnHapus').click(function() {
            if (!confirm('Yakin ingin menghapus data ini?')) return;

            const id = $(this).data('id');

            $.ajax({
                url: `/medicalRecord/${id}`,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Data berhasil dihapus!');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat menghapus data.');
                }
            });
        });
    </script>
@endpush
