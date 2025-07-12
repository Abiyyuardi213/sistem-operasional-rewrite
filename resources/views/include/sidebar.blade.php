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
                    #
                </a>
                <span class="badge badge-success">Online</span>
                <span class="d-block" style="color: #f39c12; font-size: 14px; font-weight: 600;">
                    #
                </span>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false" role="menu">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>Dashboard Utama</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Peran</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
