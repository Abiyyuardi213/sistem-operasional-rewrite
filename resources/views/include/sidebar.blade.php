<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo -->
    <a href="#" class="brand-link d-flex flex-column align-items-center p-2" style="overflow: hidden;">
        <img src="{{ asset('image/kai.png') }}"
             alt="Logo Dropcore"
             class="img-fluid d-none d-md-block"
             style="max-height: 40px; object-fit: contain;">
        <img src="{{ asset('image/kai.png') }}"
             alt="Logo Mini Dropcore"
             class="img-fluid d-block d-md-none"
             style="max-height: 100px; object-fit: contain;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Info -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="#"
                    class="img-circle elevation-2"
                    alt="User"
                    style="width: 45px; height: 45px; object-fit: cover; border: 2px solid white;">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white font-weight-bold">
                    Nama User
                </a>
                <span class="badge badge-success">Online</span>
                <span class="d-block" style="color: #f39c12; font-size: 14px; font-weight: 600;">
                    Status Online
                </span>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false" role="menu">
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard Utama</p>
                    </a>
                </li>

                @php
                    $isPeranPengguna = request()->is('dashboard-peran*') ||
                                request()->is('role*') ||
                                request()->is('user*');
                @endphp
                <li class="nav-item has-treeview {{ $isPeranPengguna ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isPeranPengguna ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            Peran Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isPeranPengguna ? 'display: block;' : '' }}">
                        <li class="nav-item">
                            <a href="{{ url('dashboard-peran') }}" class="nav-link">
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('role') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>Master Peran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('user') }}" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Master Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
