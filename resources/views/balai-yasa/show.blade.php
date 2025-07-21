<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Balai Yasa</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo-kai.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
            background-color: #f4f6f9;
        }
        .card {
            border-radius: 1rem;
            overflow: hidden;
        }
        .card-header {
            border-bottom: none;
            padding: 1.5rem;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .user-info {
            background: #ffffff;
            border-radius: 0.75rem;
            padding: 1.5rem;
        }
        .info-item {
            margin-bottom: 1rem;
        }
        .info-label {
            font-weight: 600;
            color: #6c757d;
        }
        .info-value {
            font-size: 1rem;
            font-weight: 500;
            color: #343a40;
        }
        .btn-back {
            font-weight: 500;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('include.navbarSistem')
    @include('include.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Detail Balai Yasa</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid d-flex justify-content-center">
                <div class="card shadow w-100" style="max-width: 1000px;">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <h3 class="card-title text-primary"><i class="fas fa-industry mr-2"></i>Informasi Balai Yasa</h3>
                    </div>
                    <div class="card-body">
                        <div class="user-info">
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-id-badge mr-1"></i> ID</span><br>
                                <span class="info-value">{{ $balai->id }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-warehouse mr-1"></i> Nama Balai</span><br>
                                <span class="info-value">{{ $balai->nama_balai }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-map-marker-alt mr-1"></i> Kota</span><br>
                                <span class="info-value">{{ $balai->kota->kota ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-map-marked-alt mr-1"></i> Alamat</span><br>
                                <span class="info-value">{{ $balai->alamat }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-phone mr-1"></i> Telepon</span><br>
                                <span class="info-value">{{ $balai->telepon }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-user-tie mr-1"></i> Kepala Balai</span><br>
                                <span class="info-value">{{ $balai->kepala_balai }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-info-circle mr-1"></i> Deskripsi</span><br>
                                <span class="info-value">{{ $balai->deskripsi ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-toggle-on mr-1"></i> Status</span><br>
                                <span class="info-value">
                                    @if ($balai->status)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Nonaktif</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('balai-yasa.index') }}" class="btn btn-secondary btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

@include('services.logoutModal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
