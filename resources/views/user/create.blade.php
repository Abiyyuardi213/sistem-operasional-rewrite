<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo-kai.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"/>
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
                            <h1 class="m-0">Tambah Pengguna Baru</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-plus-circle"></i> Form Tambah Pengguna</h3>
                        </div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Kiri -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Nama Pengguna</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
                                            @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Pengguna</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="no_telepon">Nomor Telepon</label>
                                            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon" value="{{ old('no_telepon') }}">
                                            @error('no_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <!-- Tengah -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="role_id">Role</label>
                                            <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                                <option value="">-- Pilih Role --</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <!-- Kanan: Foto -->
                                    <div class="col-md-4 text-center">
                                        <div class="form-group">
                                            <label for="profile_picture">Foto Profil</label>
                                            <input type="file" name="profile_picture" id="profile_picture" class="form-control-file @error('profile_picture') is-invalid @enderror" accept="image/*">
                                            @error('profile_picture')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div style="width: 300px; height: 300px; border: 2px dashed #ccc; margin: auto; display: flex; align-items: center; justify-content: center;">
                                            <img id="preview" src="https://via.placeholder.com/300x300?text=Preview" class="img-fluid rounded" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                        </div>
                                        <input type="hidden" name="cropped_image" id="cropped_image">
                                    </div>
                                </div>

                                <!-- Tombol -->
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-widget="treeview"]').Treeview('init');
        });

        let cropper;
        const image = document.getElementById('preview');
        const input = document.getElementById('profile_picture');

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = () => {
                image.src = reader.result;

                if (cropper) cropper.destroy();
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    crop(event) {
                        const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });
                        canvas.toBlob((blob) => {
                            const formData = new FormData();
                            formData.append('cropped_image', blob);
                            // Opsional: preview bisa diupload via AJAX kalau ingin disimpan langsung
                        });
                    }
                });
            };
            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>
