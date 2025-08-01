<!-- Sidebar ala SB Admin Pro -->
<aside class="main-sidebar sidebar-light-primary elevation-1" style="background-color: #f8f9fc;">
    <!-- Brand Logo - versi bersih dan proporsional -->
    <a href="{{ url('dashboard') }}" class="d-flex justify-content-center align-items-center py-3" style="background-color: #fff;">
        <img src="{{ asset('image/kai.png') }}"
            alt="Logo KAI"
            style="height: 25px; object-fit: contain;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Info -->
        <div class="user-panel d-flex align-items-center mb-3 px-3">
            <div class="image">
                <img src="{{ asset('uploads/profile/' . (Auth::user()->profile_picture ?? 'default.png')) }}"
                    class="img-circle elevation-2"
                    alt="User Image"
                    style="width: 45px; height: 45px; object-fit: cover; border: 2px solid white;">
            </div>
            <div class="info ml-2">
                <a href="#" class="d-block text-dark font-weight-bold">
                    {{ Auth::user()->username }}
                </a>
                <span class="badge badge-success">Online</span>
                <span class="d-block" style="color: #f39c12; font-size: 14px; font-weight: 600;">
                    {{ Auth::user()->role->role_name ?? 'Unknown' }}
                </span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-primary"></i>
                        <p class="ml-1">Dashboard Utama</p>
                    </a>
                </li>

                @php
                    $isPeranPengguna = request()->is('dashboard-peran*') || request()->is('role*') || request()->is('user*');
                @endphp
                <li class="nav-item has-treeview {{ $isPeranPengguna ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isPeranPengguna ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users text-primary"></i>
                        <p>
                            Peran & Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="{{ $isPeranPengguna ? 'display:block;' : '' }}">
                        <li class="nav-item">
                            <a href="{{ url('dashboard-peran') }}" class="nav-link">
                                <i class="fas fa-columns nav-icon text-secondary"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('role') }}" class="nav-link">
                                <i class="fas fa-user-shield nav-icon text-secondary"></i>
                                <p>Master Peran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('user') }}" class="nav-link">
                                <i class="fas fa-users-cog nav-icon text-secondary"></i>
                                <p>Master Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @php
                    $isMasterData = request()->is('dashboard-master') ||
                                    request()->is('pulau*') ||
                                    request()->is('kota*') ||
                                    request()->is('kantor*') ||
                                    request()->is('daop*') ||
                                    request()->is('balai-yasa*') ||
                                    request()->is('kategori-resort*') ||
                                    request()->is('resort*');
                @endphp
                <li class="nav-item has-treeview {{ $isMasterData ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isMasterData ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open text-primary"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="{{ $isMasterData ? 'display:block;' : '' }}">
                        <li class="nav-item">
                            <a href="{{ url('dashboard-master') }}" class="nav-link">
                                <i class="fas fa-columns nav-icon text-secondary"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('pulau') }}" class="nav-link">
                                <i class="fas fa-map nav-icon text-secondary"></i>
                                <p>Master Pulau</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kota') }}" class="nav-link">
                                <i class="fas fa-city nav-icon text-secondary"></i>
                                <p>Master Kota</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kantor') }}" class="nav-link">
                                <i class="fas fa-building nav-icon text-secondary"></i>
                                <p>Master Kantor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('daop') }}" class="nav-link">
                                <i class="fas fa-route nav-icon text-secondary"></i>
                                <p>Master Daop</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('balai-yasa') }}" class="nav-link">
                                <i class="fas fa-wrench nav-icon text-secondary"></i>
                                <p>Master Balai Yasa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kategori-resort') }}" class="nav-link">
                                <i class="fas fa-th-large nav-icon text-secondary"></i>
                                <p>Master Kategori Resort</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('resort') }}" class="nav-link">
                                <i class="fas fa-tools nav-icon text-secondary"></i>
                                <p>Master Resort</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @php
                    $isMasterDipo = request()->is('dashboard-master-dipo*') ||
                                    request()->is('dipo-lokomotif*') ||
                                    request()->is('dipo-kereta*');
                @endphp
                <li class="nav-item has-treeview {{ $isMasterDipo ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isMasterDipo ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open text-primary"></i>
                        <p>
                            Master Dipo
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="{{ $isMasterDipo ? 'display:block;' : '' }}">
                        <li class="nav-item">
                            <a href="{{ url('dashboard-master-dipo') }}" class="nav-link">
                                <i class="fas fa-columns nav-icon text-secondary"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('dipo-lokomotif') }}" class="nav-link">
                                <i class="fas fa-train nav-icon text-secondary"></i>
                                <p>Master Dipo Lokomotif</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('dipo-kereta') }}" class="nav-link">
                                <i class="fas fa-subway nav-icon text-secondary"></i>
                                <p>Master Dipo Kereta</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @php
                    $isSarana = request()->is('dashboard-sarana*') ||
                                request()->is('jenis-lokomotif*') ||
                                request()->is('lokomotif*') ||
                                request()->is('kereta*');
                @endphp
                <li class="nav-item has-treeview {{ $isSarana ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isSarana ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open text-primary"></i>
                        <p>
                            Master Sarana
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="{{ $isSarana ? 'display:block;' : '' }}">
                        <li class="nav-item">
                            <a href="{{ url('dashboard-sarana') }}" class="nav-link">
                                <i class="fas fa-columns nav-icon text-secondary"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('jenis-lokomotif') }}" class="nav-link">
                                <i class="fas fa-train nav-icon text-secondary"></i>
                                <p>Master Jenis Lokomotif</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('lokomotif') }}" class="nav-link">
                                <i class="fas fa-train nav-icon text-secondary"></i>
                                <p>Master Lokomotif</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kereta') }}" class="nav-link">
                                <i class="fas fa-subway nav-icon text-secondary"></i>
                                <p>Master Kereta</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
