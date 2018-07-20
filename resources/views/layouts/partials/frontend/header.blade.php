<!-- Main Header -->
<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="navbar-brand">{!! config('adminlte.logo_lg') !!}</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                  <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/">Link</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @endif
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endif
                    @else
                        @if (Route::has('impersonate.stop') && Auth::user()->can('stopImpersonate', \App\User::class))
                        <li>
                            <a href="{{ route('impersonate.stop') }}" class="bg-red">
                                <i class="fa fa-user-secret"></i><!-- Stop Impersonating -->
                            </a>
                        </li>
                        @endif

                        @if (Route::has('dashboard::index'))
                            <li><a href="{{ route('dashboard::index') }}"><i class="fa fa-dashboard"></i></a></li>
                        @endif
                        <!-- User Account -->
                        <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ Auth::user()->getLogoPath() }}" class="user-image"
                                         alt="{{ Auth::user()->name }}">
                                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="{{ Auth::user()->getLogoPath() }}" class="img-circle"
                                             alt="{{ Auth::user()->name }}">

                                        <p>
                                            {{ Auth::user()->name }}
                                            <small>Member since {{ Carbon::parse(Auth::user()->created_at)->toFormattedDateString() }}</small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ route('dashboard::profile') }}" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                               class="btn btn-default btn-flat">
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                    @endguest
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>
