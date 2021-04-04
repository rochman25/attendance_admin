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
                    <label class="badge badge-success">2</label><a class="sidebar-link sidebar-title" href="#"><i
                            data-feather="home"></i><span class="lan-3">Dashboard </span></a>
                    <ul class="sidebar-submenu">
                        <li><a class="lan-4" href="{{ route('home.view') }}">Default</a></li>
                        <li><a class="lan-5" href="dashboard-02.html">Ecommerce</a></li>
                    </ul>
                </li>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                            data-feather="airplay"></i><span class="lan-6">Widgets</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="general-widget.html">General</a></li>
                        <li><a href="chart-widget.html">Chart</a></li>
                    </ul>
                </li>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                            data-feather="layout"></i><span class="lan-7">Page layout</span></a>
                    <ul class="sidebar-submenu">
                        <li><a href="box-layout.html">Boxed</a></li>
                        <li><a href="layout-rtl.html">RTL</a></li>
                        <li><a href="layout-dark.html">Dark Layout</a></li>
                        <li><a href="hide-on-scroll.html">Hide Nav Scroll</a></li>
                        <li><a href="footer-light.html">Footer Light</a></li>
                        <li><a href="footer-dark.html">Footer Dark</a></li>
                        <li><a href="footer-fixed.html">Footer Fixed</a></li>
                    </ul>
                </li>
                <li class="sidebar-main-title">
                    <div>
                        <h6>Settings</h6>
                    </div>
                </li>
                <li><a class="sidebar-link" href="#"><i data-feather="share-2"></i><span class="lan-10">Role</span></a>
                </li>
                <li><a class="sidebar-link" href="#"><i data-feather="users"></i><span class="lan-11">Pengguna</span></a>
                </li>
            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
</div>
