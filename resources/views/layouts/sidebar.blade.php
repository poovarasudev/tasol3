<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                     xml:space="preserve">
                <g>
                    <polygon class="st0" points="78,105 15,105 24,87 87,87 	"/>
                    <polygon class="st0" points="96,69 33,69 42,51 105,51 	"/>
                    <polygon class="st0" points="78,33 15,33 24,15 87,15 	"/>
                </g>
              </svg>
            </a>
        </div>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('teams.index') }}">
                    <i class="fe fe-tag fe-16"></i>
                    <span class="ml-3 item-text">Teams</span>
                </a>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1"><span>Components</span></p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="">
                    <i class="fe fe-layers fe-16"></i>
                    <span class="ml-3 item-text">Widgets</span>
                </a>
            </li>
        </ul>

        <div class="btn-box w-100 mt-4 mb-1">
            <a href="{{ route('logout') }}" target="_blank" class="btn mb-2 btn-primary btn-lg btn-block"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fe  fe-log-out fe-16"></i><span class="ml-3 item-text">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>
</aside>
