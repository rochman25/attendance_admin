<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper">
            {{-- <div class="logo-wrapper">
                <a href="{{ route('home.view') }}">
                </a>
            </div> --}}
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="sliders"></i></div>
        </div>
        <div class="nav-right col-12 pull-right right-header p-0">
            <ul class="nav-menus">
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>
                <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                            data-feather="maximize"></i></a></li>
                <li class="profile-nav onhover-dropdown p-0 mr-0">
                    <div class="media profile-media"><img class="b-r-10" src="{{ asset('assets/images/dashboard/profile.jpg') }}"
                            alt="">
                        <div class="media-body"><span>{{ Auth::user()->name }}</span>
                            <p class="mb-0 font-roboto">{{ Auth::user()->getRoleNames()}} <i class="middle fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        {{-- <li><a href="#"><i data-feather="user"></i><span>Account </span></a></li> --}}
                        {{-- <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a></li> --}}
                        <li><a href="{{ route('auth.logout') }}"><i data-feather="log-in"> </i><span>Log Out</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
