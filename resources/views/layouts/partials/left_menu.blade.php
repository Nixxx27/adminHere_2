
<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><img src="{{url('public/images/users/profile.png')}}" alt="user" /><span class="hide-menu"><b>{{ strtoupper(\Auth::user()->name)}}</b></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('password')}}"><i class="fas fa-unlock-alt"></i> Change Password </a></li>
                                <li><a href="{{url('logout')}}" onclick="return confirm('Are you sure you want to Logout?')"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                        <li><a href="{{url('home')}}"><i class="fas fa-tachometer-alt" style="color:#002065"></i><span class="hide-menu"> <b>DASHBOARD</b> </span></a></li>

                        <li><a href="{{url('barcode')}}"><i class="fas fa-barcode" style="color:#002065"></i><span class="hide-menu"><b>BARCODE APP</b></span></a></li>

                        <li><a href="{{url('trolleys')}}"><i class="fas fa-shopping-cart" style="color:#002065"></i><span class="hide-menu"> <b>TROLLEY LISTS</b> </span></a></li>

                        @if(\Auth::user()->is_admin())
                            <li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-cogs" style="color:#002065"></i><span class="hide-menu"> <b>SETTINGS</b></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('locations')}}">Locations</a></li>
                                <li><a href="{{url('trackingseries')}}">Tracking No. Series</a></li>
                            </ul>
                        </li>
                        @endif
                       
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>