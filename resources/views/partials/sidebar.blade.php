<nav class="navbar" role="navigation">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <ul class="nav navbar-nav margin-bottom-35">
                                        <li class="{{$home}}"> 
                                            <a href="{{route('home')}}">
                                                <i class="icon-home"></i> Home </a> 
                                        </li>
                                        <li class="{{$staff}}">
                                            <a href="{{ route('staff.index') }}">
                                                <i class="icon-note"></i> MDAs </a>
                                        </li> 
                                        <li class="{{$pfa}}">
                                            <a href="{{ route('showpfa_upload_form') }}">
                                                <i class="icon-note"></i> PFAs </a>
                                        </li> 
                                        <li class="{{$staff_report}}">
                                            <a href="{{ route('staffpayment.index') }}">
                                                <i class="icon-note"></i>Payment Report</a>
                                        </li> 
                                        <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="icon-lock"></i>
                                        {{ __('Logout') }}
                                    </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                          
                                        </li> 
                                    </ul>
                                  
                                </nav>
