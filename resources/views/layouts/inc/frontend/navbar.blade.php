<nav class="navbar navbar-expand topbar mb-4 static-top shadow nav-user">


    <a class="navbar-brand d-none d-sm-block" href="#">
        <img src="uploads/global_white_horizontal.webp" alt="" style="width:225px; height:43px;">
    </a>


    <!-- Topbar Search -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link navuser-link {{ Request::url() == url('/home') ? 'active' : '' }}" title="Dashboard"><span style="font-size:13px;" class="ml-1">Home</span></a>
        </li>


        <li class="nav-item">
            <a href="{{ url('/products') }}" class="nav-link navuser-link {{ Request::url() == url('/products') ? 'active' : '' }}" title="Inventory"><span style="font-size:13px;" class="ml-1">Inventory</span></a>
        </li>


        <li class="nav-item">
            <a href="{{ url('/checkins') }}" class="nav-link navuser-link {{ Request::url() == url('/checkins') ? 'active' : '' }}" title="Check-ins"><span style="font-size:13px;" class="ml-1">Check-ins</span></a>
        </li>


        <li class="nav-item dropdown no-arrow">
            <a href="" class="nav-link navuser-link dropdown-toggle {{ Request::url() == url('/checkouts') ? 'active' : '' }}{{ Request::url() == url('/returns') ? 'active' : '' }}{{ Request::url() == url('/borrowed-items') ? 'active' : '' }}{{ Request::url() == url('/purchase-returns') ? 'active' : '' }}" title="Checkouts" role="button"
                data-toggle="dropdown" aria-expanded="false"><span style="font-size:13px;" class="ml-1">Checkouts</span></a>
            <div class="dropdown-menu">
                <a class="dropdown-item disabled" href="#">Checkout Menu:</a>
                <a class="dropdown-item {{ Request::url() == url('/checkouts') ? 'active' : '' }}" href="{{ url('/checkouts') }}">Checkouts</a>
                <a class="dropdown-item {{ Request::url() == url('/returns') ? 'active' : '' }}" href="{{ url('/returns') }}">Returns</a>
                <a class="dropdown-item {{ Request::url() == url('/borrowed-items') ? 'active' : '' }}" href="{{ url('/borrowed-items') }}">Borrow Items</a>
                <a class="dropdown-item {{ Request::url() == url('/purchase-returns') ? 'active' : '' }}" href="{{ url('/purchase-returns') }}">Purchase Returns</a>
            </div>
        </li>
    </ul>
    {{-- <form
class="d-none d-sm-inline-block form-inline ml-md-3 my-2 my-md-0 mw-100 navbar-search">
<div class="input-group">
    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
        aria-label="Search" aria-describedby="basic-addon2">
    <div class="input-group-append">
        <button class="btn btn-primary" type="button">
            <i class="fas fa-search fa-sm"></i>
        </button>
    </div>
</div>
</form> --}}
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" style="color:white;">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>


        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span style="font-size:11px;" class="mr-2 d-none d-lg-inline text-white text-uppercase">{{ Auth::user()->name }}</span></span>
                <img class="img-profile rounded-circle" src="uploads/global-white.png">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a type="button" href="{{ url('edit-password') }}" class="dropdown-item">
                    <i class="fa-solid fa-passport mr-2 text-gray-400"></i>
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item"
                    href="{{ route('logout') }}"onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"data-toggle="modal"
                    data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('Logout') }}


                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>


    </ul>


</nav>
