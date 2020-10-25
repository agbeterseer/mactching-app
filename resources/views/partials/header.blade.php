<nav class="navbar mega-menu" role="navigation">
                    <div class="container-fluid">
                        <div class="clearfix navbar-fixed-top">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="toggle-icon">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </span>
                            </button>
                            <!-- End Toggle Button -->
                            <!-- BEGIN LOGO -->
                            <a id="index" class="page-logo" href="{{route('home')}}">
                                <img src="{{asset('./img/xxx-logo.png')}}" alt="Logo"> </a>
                            <!-- END LOGO -->
                            <!-- BEGIN SEARCH -->
                            <!-- <form class="search" action="extra_search.html" method="GET">
                                <input type="name" class="form-control" name="query" placeholder="Search...">
                                <a href="javascript:;" class="btn submit md-skip">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form> -->
                            <!-- END SEARCH -->
                            <!-- BEGIN TOPBAR ACTIONS -->
                            <div class="topbar-actions">
                                <!-- BEGIN GROUP NOTIFICATION -->
                                 
                                <!-- END GROUP NOTIFICATION -->
                                <!-- BEGIN GROUP INFORMATION -->
                              
                                <!-- END GROUP INFORMATION -->
                                <!-- BEGIN USER PROFILE -->
                                <div class="btn-group-img btn-group">
                                @guest
                                <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                                    <button type="button" class="btn btn-sm md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <span>Hi, {{Auth::user()->name}}</span>
                                        <img src="{{asset('img/upload.png')}}" alt=""> </button>
                                    <ul class="dropdown-menu-v2" role="menu">
                                    
                                        <li class="divider"> </li> 
                                        <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="icon-key"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
 
                                        </li>
                                    </ul>
                                    @endguest
                                </div>
                                <!-- END USER PROFILE -->
                                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                                <button type="button" class="quick-sidebar-toggler md-skip" data-toggle="collapse">
                                    <span class="sr-only">Toggle Quick Sidebar</span>
                                    <i class="icon-logout"></i>
                                </button>
                                <!-- END QUICK SIDEBAR TOGGLER -->
                            </div>
                            <!-- END TOPBAR ACTIONS -->
                        </div>
                        <!-- BEGIN HEADER MENU -->

                        <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
                            <ul class="nav navbar-nav">
                                <li class="dropdown dropdown-fw dropdown-fw-disabled  {{$dashboard_}}">
                                    <a href="javascript:;" class="text-uppercase">
                                        <i class="icon-home"></i> Dashboard </a>
                                    <ul class="dropdown-menu dropdown-menu-fw">
                                        <li class="active">
                                            <a href="{{route('home')}}">
                                                <i class="icon-bar-chart"></i> Home </a>
                                        </li> 
                                    </ul>
                                </li>
                                <li class="dropdown dropdown-fw dropdown-fw-disabled {{$menu}} ">
                                    <a href="javascript:;" class="text-uppercase">
                                        <i class="icon-puzzle"></i> Menu </a>
                                    <ul class="dropdown-menu dropdown-menu-fw">
                                        <li class="dropdown">
                                            <a href="{{route('staff.index')}}">
                                                <i class="icon-diamond"></i> Upload Staff List </a> 
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{route('showpfa_upload_form')}}">
                                                <i class="icon-puzzle"></i> Upload PFA's Registration List </a> 
                                        </li>
                                        <!-- <li class="dropdown">
                                            <a href="javascript:;">
                                                <i class="icon-settings"></i> MDAs Monthly Report </a> 
                                        </li>
                                        <li class="dropdown">
                                            <a href="">
                                                <i class="icon-settings"></i> Match Records </a> 
                                        </li> -->
                              
                            </ul>
                        </div>
                        <!-- END HEADER MENU -->
                    </div>
                    <!--/container-->
                </nav>
 