<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img src="{{asset('kanas.png')}}" width="60px" height="60px" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Kana's Kitchen</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : ''  }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @if ((auth()->user()->role == 'admin') || (auth()->user()->role == 'user'))
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading Bahan-->
        <div class="sidebar-heading">
            Bahan Baku
        </div>
        <li class="nav-item {{ request()->is('bahan') ? 'active' : ''  }}">
            <a class="nav-link" href="/bahan">
                <i class="fas fa-fw fa-cubes"></i>
                <span>Bahan</span></a>
        </li>

        <!-- Nav Item - Pages Collapse Menu Resep -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cube"></i>
                <span>Resep</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Resep Menu</h6>
                    <a class="collapse-item {{ request()->is('resep') ? 'active' : ''  }}" href="/resep">Tambah Resep</a>
                    <a class="collapse-item {{ request()->is('resep-details') ? 'active' : ''  }}" href="/resepdetails">Resep Details</a>
                </div>
            </div>
        </li>

        {{-- supplier --}}
        <li class="nav-item {{ request()->is('supplier') ? 'active' : ''  }}">
            <a class="nav-link" href="/supplier">
                <i class="fas fa-fw fa-id-badge"></i>
                <span>Supplier</span></a>
        </li>
    @endif

    @if ((auth()->user()->role == 'admin') || (auth()->user()->role == 'hr'))

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            HR Menu
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                aria-controls="collapsePages">
                <i class="fas fa-fw fa-users"></i>
                <span>Karyawan</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kehadiran</h6>
                    <a class="collapse-item {{ request()->is('kehadiran') ? 'active' : ''  }}" href="/kehadiran">Kehadiran</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Tambah Karyawan</h6>
                    <a class="collapse-item {{ request()->is('karyawan') ? 'active' : ''  }}" href="/karyawan">Karyawan</a>
                </div>
            </div>
        </li>
        @if (auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true"
                aria-controls="collapsePages">
                <i class="fas fa-fw fa-hand-holding-usd"></i>
                <span>Gaji</span>
            </a>
            <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Penggajian</h6>
                    <a class="collapse-item {{ request()->is('gaji') ? 'active' : ''  }}" href="/gaji">Gaji</a>
                    <a class="collapse-item {{ request()->is('mastergaji') ? 'active' : ''  }}" href="/mastergaji">Master Gaji</a>
                    <a class="collapse-item {{ request()->is('tunjangangaji') ? 'active' : ''  }}" href="/tunjangangaji">Gaji Tunjangan</a>

                </div>
            </div>
        </li>
        @endif
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
