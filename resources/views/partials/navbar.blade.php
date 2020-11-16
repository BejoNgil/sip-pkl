<nav class="navbar navbar-default top-navbar" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('logo-new.png') }}" alt="" style="height: 45px; width: 150px; margin: -7px;">
        </a>
        <div id="sideNav" href="">
            <i class="fa fa-bars icon"></i>
        </div>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
{{--        <li class="dropdown">--}}
{{--            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">--}}
{{--                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>--}}
{{--            </a>--}}
{{--            <ul class="dropdown-menu dropdown-alerts">--}}
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <div>--}}
{{--                            <i class="fa fa-comment fa-fw"></i> New Comment--}}
{{--                            <span class="pull-right text-muted small">4 min</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="divider"></li>--}}
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <div>--}}
{{--                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers--}}
{{--                            <span class="pull-right text-muted small">12 min</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="divider"></li>--}}
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <div>--}}
{{--                            <i class="fa fa-envelope fa-fw"></i> Message Sent--}}
{{--                            <span class="pull-right text-muted small">4 min</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="divider"></li>--}}
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <div>--}}
{{--                            <i class="fa fa-tasks fa-fw"></i> New Task--}}
{{--                            <span class="pull-right text-muted small">4 min</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="divider"></li>--}}
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <div>--}}
{{--                            <i class="fa fa-upload fa-fw"></i> Server Rebooted--}}
{{--                            <span class="pull-right text-muted small">4 min</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="divider"></li>--}}
{{--                <li>--}}
{{--                    <a class="text-center" href="#">--}}
{{--                        <strong>See All Alerts</strong>--}}
{{--                        <i class="fa fa-angle-right"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--            <!-- /.dropdown-alerts -->--}}
{{--        </li>--}}
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="{{ auth()->user()->linkProfil() }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                            class="fa fa-sign-out fa-fw"></i> {{ __('Logout') }}</a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    @csrf
                </form>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
</nav>
