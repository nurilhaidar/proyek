<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">HMTI<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('administrator/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('administrator/inventaris') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Inventaris</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('administrator/peminjaman') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data Peminjaman</span></a>
    </li>

    @if (Auth::user()->role == '1')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('administrator/user') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Data User</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">
</ul>
