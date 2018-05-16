
<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><img src="{{url('public/images/users/profile.png')}}" alt="user" /><span class="hide-menu"><b>{{ strtoupper(\Auth::user()->name)}}</b></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="javascript:void()">My Profile </a></li>
                                <li><a href="javascript:void()">My Balance</a></li>
                                <li><a href="javascript:void()">Inbox</a></li>
                                <li><a href="javascript:void()">Account Setting</a></li>
                                <li><a href="javascript:void()">Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                        <li><a href="{{url('home')}}"><i class="fas fa-tachometer-alt" style="color:#244354"></i> Dashboard</a></li>


                        {{-- <li class="nav-small-cap" style="font-weight: bold;background:#1ba196;color:white">SICK LEAVE</li>
                        <li><a href="{{url('patients/create')}}"><i class="fas fa-plus-circle" style="color:#244354"></i> New</a>
                        <li><a href="{{url('patients')}}"><i class="far fa-list-alt" style="color:#244354"></i> List</a></li> 
 --}}
                        <li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-file-medical" style="color:#244354"></i><span class="hide-menu"> Sick Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('sl/create')}}"><i class="fas fa-plus-circle" style="color:#244354"></i> New</a></li>
                                <li><a href="{{url('sl')}}"><i class="far fa-list-alt" style="color:#244354"></i> List</a></li>
                            </ul>
                        </li>

                        <li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-notes-medical" style="color:#244354"></i><span class="hide-menu"> Clearance </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('sl/create')}}"><i class="fas fa-plus-circle" style="color:#244354"></i> New</a></li>
                                <li><a href="{{url('sl')}}"><i class="far fa-list-alt" style="color:#244354"></i> List</a></li>
                            </ul>
                        </li>

                         <li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-user" style="color:#244354"></i><span class="hide-menu"> Employee </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('employees/create')}}"><i class="fas fa-plus-circle" style="color:#244354"></i> New</a></li>
                                <li><a href="{{url('employees')}}"><i class="far fa-list-alt" style="color:#244354"></i> List</a></li>
                            </ul>
                        </li>


                       {{--  <li class="nav-small-cap">EMPLOYEE LISTS</li>
                        <li><a href="{{url('patients/create')}}"><i class="fas fa-plus-circle" style="color:#244354"></i> New</a></li> 
                        <li><a href="{{url('patients')}}"><i class="far fa-list-alt" style="color:#244354"></i> List</a></li> 
 --}}
                       {{--  <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">List</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="table-basic.html">Basic Tables</a></li>
                            </ul>
                        </li> --}}
                            <li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-cogs" style="color:#244354"></i><span class="hide-menu"> Settings</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="map-google.html">Company</a></li>
                                <li><a href="map-vector.html">Department</a></li>
                            </ul>
                        </li>
                       
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>