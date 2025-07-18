<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kota - PT KAI</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo-kai.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('include.navbarSistem')
        @include('include.sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Manajemen Kota</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Kota</h3>
                            <a href="#" class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#addKotaModal">
                                <i class="fas fa-plus"></i> Tambah Kota
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Kolom Kiri: Tabel -->
                                <div class="col-md-9">
                                    <div class="table-responsive">
                                        <table id="kotaTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Kota</th>
                                                    <th>Pulau</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($kotas as $index => $kota)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $kota->kota }}</td>
                                                        <td>{{ $kota->pulau->nama_pulau }}</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-warning btn-sm edit-kota-btn"
                                                                data-toggle="modal"
                                                                data-target="#editKotaModal"
                                                                data-id="{{ $kota->id }}"
                                                                data-pulau-id="{{ $kota->pulau->id }}"
                                                                data-kota="{{ $kota->kota }}">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </button>
                                                            <button class="btn btn-danger btn-sm delete-kota-btn"
                                                                data-toggle="modal"
                                                                data-target="#deleteKotaModal"
                                                                data-kota-id="{{ $kota->id }}">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Kolom Kanan: Filter -->
                                <div class="col-md-3">
                                    <div class="card card-outline card-secondary">
                                        <div class="card-header">
                                            <h5 class="card-title m-0"><i class="fas fa-filter"></i> Filter Pulau</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="filterPulau">Pilih Pulau</label>
                                                <select id="filterPulau" class="form-control">
                                                    <option value="">Semua Pulau</option>
                                                    @foreach($pulaus as $pulau)
                                                        <option value="{{ $pulau->nama_pulau }}">{{ $pulau->nama_pulau }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteKotaModal" tabindex="-1" aria-labelledby="deleteKotaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteKotaModalLabel"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Kota ini? Tindakan ini tidak dapat dibatalkan.
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kota -->
    <div class="modal fade" id="addKotaModal" tabindex="-1" role="dialog" aria-labelledby="addKotaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('kota.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="addKotaModalLabel">Tambah Kota Baru</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pulau_id">Pulau</label>
                            <select name="pulau_id" id="pulau_id" class="form-control @error('pulau_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Pulau --</option>
                                @foreach($pulaus as $pulau)
                                    <option value="{{ $pulau->id }}" {{ old('pulau_id') == $pulau->id ? 'selected' : '' }}>
                                        {{ $pulau->nama_pulau }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pulau_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="kota">Nama Kota</label>
                            <input type="text" name="kota" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Kota -->
    <div class="modal fade" id="editKotaModal" tabindex="-1" aria-labelledby="editKotaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editKotaForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title" id="editKotaLabel"><i class="fas fa-edit"></i> Ubah Kota</h5>
                        <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pulau_id">Pulau</label>
                            <select name="pulau_id" id="edit_pulau_id" class="form-control" required>
                                <option value="">-- Pilih Pulau --</option>
                                @foreach($pulaus as $pulau)
                                    <option value="{{ $pulau->id }}">{{ $pulau->nama_pulau }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Kota</label>
                            <input type="text" name="kota" id="editKota" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('services.ToastModal')
    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/ToastScript.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#kotaTable").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });

        $(document).ready(function () {
            $('.delete-kota-btn').click(function () {
                let kotaId = $(this).data('kota-id');
                let deleteUrl = "{{ url('kota') }}/" + kotaId;
                $('#deleteForm').attr('action', deleteUrl);
            });
        });

        $(document).ready(function() {
            @if (session('success') || session('error'))
                $('#toastNotification').toast({
                    delay: 3000,
                    autohide: true
                }).toast('show');
            @endif
        });

        $('#addWKotaModal').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset();
        });

        $(document).on('click', '.edit-kota-btn', function () {
            let id = $(this).data('id');
            let pulauId = $(this).data('pulauId');
            let kotaId = $(this).data('kota_id');
            let kota = $(this).data('kota');

            $('#editKotaId').val(id);
            $('#edit_pulau_id').val(pulauId);
            $('#editKota').val(kota);

            let actionUrl = "{{ url('kota') }}/" + id;
            $('#editKotaForm').attr('action', actionUrl);
        });

        $(document).ready(function () {
            let table = $("#kotaTable").DataTable();

            $('#filterPulau').on('change', function () {
                let selected = $(this).val();
                table.column(2).search(selected).draw();
            });
        });
    </script>
</body>
</html>
