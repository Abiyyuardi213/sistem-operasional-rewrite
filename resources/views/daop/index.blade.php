<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantor - PT KAI</title>
    <link rel="icon" href="{{ asset('image/logo-kai.jpg') }}">
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
                        <h1 class="m-0">Manajemen Daerah Operasi</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Daftar Daerah Operasi</h3>
                        <a href="#" class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#addDaopModal">
                            <i class="fas fa-plus"></i> Tambah Daerah Operasi
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="daopTable" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Daop</th>
                                        <th>Deskripsi</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Status</th>
                                        <th class="text-center" style="width: 120px;">Aksi</th> <!-- Tambah kolom aksi -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($daops as $index => $daop)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $daop->nama_daop }}</td>
                                            <td>{{ $daop->deskripsi }}</td>
                                            <td>{{ $daop->alamat }}</td>
                                            <td>{{ $daop->telepon ?? '-' }}</td>
                                            <td>
                                                <span class="badge {{ $daop->status ? 'badge-success' : 'badge-secondary' }}">
                                                    {{ $daop->status ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-warning btn-sm edit-daop-btn"
                                                    data-id="{{ $daop->id }}"
                                                    data-nama="{{ $daop->nama_daop }}"
                                                    data-deskripsi="{{ $daop->deskripsi }}"
                                                    data-alamat="{{ $daop->alamat }}"
                                                    data-telepon="{{ $daop->telepon }}"
                                                    data-status="{{ $daop->status }}"
                                                    data-toggle="modal" data-target="#editDaopModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('daop.destroy', $daop->id) }}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus daop ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

<!-- Modal Tambah Daop -->
<div class="modal fade" id="addDaopModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('daop.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Daop</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Daop</label>
                        <input type="text" name="nama_daop" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                    name="deskripsi" required placeholder="Masukkan deskripsi daop">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telepon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="1" checked>
                                <label class="form-check-label">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="0">
                                <label class="form-check-label">Nonaktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Daop -->
<div class="modal fade" id="editDaopModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="editDaopForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Edit Daop</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group">
                        <label>Nama Daop</label>
                        <input type="text" name="nama_daop" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" id="edit_deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="edit_alamat" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telepon" id="edit_telepon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="edit_status_aktif" value="1">
                                <label class="form-check-label" for="edit_status_aktif">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="edit_status_nonaktif" value="0">
                                <label class="form-check-label" for="edit_status_nonaktif">Nonaktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
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
<script>

    $(document).ready(function() {
        @if (session('success') || session('error'))
            $('#toastNotification').toast({
                delay: 3000,
                autohide: true
            }).toast('show');
        @endif
    });

    $(document).ready(function () {
        $('#daopTable').DataTable();

        $('.edit-daop-btn').on('click', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const deskripsi = $(this).data('deskripsi');
            const alamat = $(this).data('alamat');
            const telepon = $(this).data('telepon');
            const status = $(this).data('status'); // status: 1 atau 0

            // Isi form input
            $('#edit_id').val(id);
            $('#edit_nama').val(nama);
            $('#edit_deskripsi').val(deskripsi);
            $('#edit_alamat').val(alamat);
            $('#edit_telepon').val(telepon);

            // Atur status radio button
            if (status == 1) {
                $('#edit_status_aktif').prop('checked', true);
            } else {
                $('#edit_status_nonaktif').prop('checked', true);
            }

            // Set form action
            $('#editDaopForm').attr('action', `/daop/${id}`);
        });
    });
</script>
</body>
</html>
