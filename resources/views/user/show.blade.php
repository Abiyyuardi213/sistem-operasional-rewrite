<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna</title>
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
        .profile-img {
            width: 180px;
            height: 180px;
            border-radius: 0.75rem;
            object-fit: cover;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
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
        .badge-role {
            font-size: 0.9rem;
            padding: 0.5rem 0.75rem;
        }
        .btn-back {
            font-weight: 500;
        }
        .content-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
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
                <h1 class="m-0 text-dark">Detail Pengguna</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid d-flex justify-content-center">
                <div class="card shadow w-100" style="max-width: 1000px;">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <h3 class="card-title text-primary"><i class="fas fa-user-circle mr-2"></i>Profil Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="{{ $user->profile_picture ? asset('uploads/profile/' . $user->profile_picture) : asset('image/default-avatar.png') }}"
                                     class="profile-img" alt="Foto Profil">
                            </div>
                            <div class="col-md-8">
                                <div class="user-info">
                                    <div class="info-item">
                                        <span class="info-label"><i class="fas fa-id-badge mr-1"></i> ID Pengguna</span><br>
                                        <span class="info-value">{{ $user->id }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label"><i class="fas fa-user mr-1"></i> Nama</span><br>
                                        <span class="info-value">{{ $user->nama_pengguna ?? $user->name }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label"><i class="fas fa-envelope mr-1"></i> Email</span><br>
                                        <span class="info-value">{{ $user->email }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label"><i class="fas fa-user-tag mr-1"></i> Username</span><br>
                                        <span class="info-value">{{ $user->username }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label"><i class="fas fa-user-shield mr-1"></i> Peran</span><br>
                                        <span class="badge badge-info badge-role">{{ $user->role->role_name ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary btn-back">
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
