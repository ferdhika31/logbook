            <header class="main-header">

                <!-- Logo -->
                <a href="{{ route('backend::dashboard') }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>LK</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>{{ config('app.name', 'Larakuy') }}</span>
                </a>
                
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="{{ Gravatar::get(Auth::user()->email) }}" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="{{ Gravatar::get(Auth::user()->email) }}" class="img-circle" alt="User Image">

                                        <p>
                                            {{ Auth::user()->name }}
                                            <small>Member since {{ substr(Auth::user()->created_at, 0,10) }}</small>
                                        </p>
                                    </li>
                                    
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" id="logout"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                Sign out
                                            </a>

                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                <input type="submit" value="logout" style="display: none;">
                                            </form>
                                        </div>
                                        
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <!-- <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li> -->
                        </ul>
                    </div>
                </nav>
            </header>