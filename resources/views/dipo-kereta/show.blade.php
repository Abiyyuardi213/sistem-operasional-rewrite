<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dipo Kereta</title>
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
                        <h1 class="m-0">Detail Dipo Kereta</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle"></i> Informasi Dipo Kereta</h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Nama Dipo</dt>
                            <dd class="col-sm-8">{{ $dipoKereta->nama_dipo }}</dd>

                            <dt class="col-sm-4">Daerah Operasi</dt>
                            <dd class="col-sm-8">{{ $dipoKereta->daop->nama_daop ?? '-' }}</dd>

                            <dt class="col-sm-4">Kota</dt>
                            <dd class="col-sm-8">{{ $dipoKereta->kota->kota ?? '-' }}</dd>

                            <dt class="col-sm-4">Alamat</dt>
                            <dd class="col-sm-8">{{ $dipoKereta->alamat ?? '-' }}</dd>

                            <dt class="col-sm-4">Telepon</dt>
                            <dd class="col-sm-8">{{ $dipoKereta->telepon ?? '-' }}</dd>

                            <dt class="col-sm-4">Kepala Dipo</dt>
                            <dd class="col-sm-8">{{ $dipoKereta->kepala_dipo ?? '-' }}</dd>

                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8">
                                <span class="badge {{ $dipoKereta->status ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $dipoKereta->status ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </dd>

                            <dt class="col-sm-4">Dibuat Pada</dt>
                            <dd class="col-sm-8">{{ $dipoKereta->created_at->format('d M Y, H:i') }}</dd>

                            <dt class="col-sm-4">Terakhir Diperbarui</dt>
                            <dd class="col-sm-8">{{ $dipoKereta->updated_at->format('d M Y, H:i') }}</dd>
                        </dl>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('dipo-kereta.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('dipo-kereta.edit', $dipoKereta->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
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
