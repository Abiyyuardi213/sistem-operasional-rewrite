<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dipo Lokomotif</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo-kai.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('include.navbarSistem')
    @include('include.sidebar')

    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Dipo Lokomotif Baru</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-plus-circle"></i> Form Tambah Dipo Lokomotif</h3>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('dipo-lokomotif.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="nama_dipo">Nama Dipo</label>
                                <input type="text" class="form-control @error('nama_dipo') is-invalid @enderror"
                                       name="nama_dipo" value="{{ old('nama_dipo') }}" required placeholder="Masukkan nama dipo lokomotif" autocomplete="off">
                                @error('nama_dipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="daop_id">Daerah Operasi</label>
                                <select name="daop_id" id="daop_id" class="form-control @error('daop_id') is-invalid @enderror">
                                    <option value="">-- Pilih Daerah Operasi --</option>
                                    @foreach($daops as $daop)
                                        <option value="{{ $daop->id }}" {{ old('daop_id') == $daop->id ? 'selected' : '' }}>{{ $daop->nama_daop }}</option>
                                    @endforeach
                                </select>
                                @error('kota_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kota_id">Kota</label>
                                <select name="kota_id" id="kota_id" class="form-control @error('kota_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kota --</option>
                                    @foreach($kotas as $kota)
                                        <option value="{{ $kota->id }}" {{ old('kota_id') == $kota->id ? 'selected' : '' }}>{{ $kota->kota }}</option>
                                    @endforeach
                                </select>
                                @error('kota_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror"
                                          name="alamat" placeholder="Masukkan alamat balai yasa">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                       name="telepon" value="{{ old('telepon') }}" placeholder="Masukkan nomor telepon (opsional)">
                                @error('telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kepala_dipo">Kepala Dipo</label>
                                <input type="text" class="form-control @error('kepala_dipo') is-invalid @enderror"
                                       name="kepala_dipo" value="{{ old('kepala_dipo') }}" placeholder="Masukkan nama kepala dipo (opsional)">
                                @error('kepala_dipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                        name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('dipo-lokomotif.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

@include('services.logoutModal')

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
