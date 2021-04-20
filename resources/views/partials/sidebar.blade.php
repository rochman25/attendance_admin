<div class="sidebar-wrapper">
    <div class="logo-wrapper"><a href="{{ route('home.view') }}"><img class="img-fluid for-light"
                src="../assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark"
                src="../assets/images/logo/logo_dark.png" alt=""></a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
        </div>
    </div>
    <div class="logo-icon-wrapper"><a href="{{ route('home.view') }}"><img class="img-fluid"
                src="../assets/images/logo/logo-icon.png" alt=""></a></div>
    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
            <ul class="sidebar-links custom-scrollbar">
                <li class="back-btn"><a href="{{ route('home.view') }}"><img class="img-fluid"
                            src="../assets/images/logo/logo-icon.png" alt=""></a>
                    <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2"
                            aria-hidden="true"></i></div>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link" href="{{ route('home.view') }}"><i
                            data-feather="home"></i>Dashboard</a>
                </li>
                {{-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                        href="{{ route('home.view') }}"><i data-feather="calendar"> </i><span>Calendar</span></a></li> --}}
                <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                            data-feather="folder"></i><span class="lan-12">Master Data</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="#">Guru</a></li>
                        <li><a href="#">Siswa</a></li>
                    </ul>
                </li>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                            data-feather="check-square"></i><span class="lan-13">Presensi</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="#">Presensi</a></li>
                        <li><a href="#">Presensi Siswa</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-link" href="#"><i data-feather="printer"></i><span
                            class="lan-14">Laporan</span></a>
                </li>
                <li class="sidebar-main-title">
                    <div>
                        <h6>Settings</h6>
                    </div>
                </li>
                <li><a class="sidebar-link" href="{{ route('roles.index') }}"><i data-feather="share-2"></i><span class="lan-10">Role</span></a>
                </li>
                <li class="sidebar-list"><a class="sidebar-link" href="{{ route('users.index') }}"><i data-feather="users"></i><span
                            class="lan-11">Pengguna</span></a>
                </li>
            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
</div>
