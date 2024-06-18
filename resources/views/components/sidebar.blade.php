<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-2" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/Logo.png') }}" alt="" width="80px">
        </div>
        <div class="sidebar-brand-text ">SDIT AL-ISTIQOMAH</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Conditionally show Data Siswa menu for admin and superadmin -->
    @hasanyrole('admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-bullseye"></i>
            <span>Extrakurikuler</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="{{ route('member') }}">Pendaftaran</a>
                <a class="collapse-item" href="{{ route('extrakurikuler') }}">List Extrakurikuler</a>
            </div>
        </div>
    </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('posts') }}">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Blog</span>
            </a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsethree"
            aria-expanded="true" aria-controls="collapsethree">
            <i class="fas fa-fw fa-user-edit"></i>
            <span>Pengaturan</span>
        </a>
        <div id="collapsethree" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="{{ route('showprofile') }}">Profile</a>
                <a class="collapse-item" href="{{ route('password.change') }}">Ubah Password</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </div>


        </li>
    @endhasanyrole

    <!-- Conditionally show Extrakurikuler menu for superadmin only -->
    @role('superadmin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-archive"></i>
            <span>Data Siswa</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="{{ route('siswa') }}">Table Siswa</a>
                <a class="collapse-item" href="{{ route('kelas') }}">Kelas</a>
            </div>
        </div>
    </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-bullseye"></i>
                <span>Extrakurikuler</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="{{ route('member') }}">Pendaftaran</a>
                    <a class="collapse-item" href="{{ route('extrakurikuler') }}">List Extrakurikuler</a>
                </div>
            </div>
        </li>


    <!-- Nav Item - Event (Visible to admin and superadmin) -->

        <li class="nav-item">
            <a class="nav-link" href="{{ route('posts') }}">
                <i class="fas fa-fw fa-edit"></i>
                <span>Blog</span>
            </a>
        </li>


    <!-- Conditionally show Galery menu for superadmin only -->

        <li class="nav-item">
            <a class="nav-link" href="{{ route('galery') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>Galery</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('user') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Manajemen Akun</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsethree"
            aria-expanded="true" aria-controls="collapsethree">
            <i class="fas fa-fw fa-user-edit"></i>
            <span>Pengaturan</span>
        </a>
        <div id="collapsethree" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="{{ route('showprofile') }}">Profile</a>
                <a class="collapse-item" href="{{ route('password.change') }}">Ubah Password</a>
            </div>
        </div>

        </li>
    @endrole

    <!-- Divider -->


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
