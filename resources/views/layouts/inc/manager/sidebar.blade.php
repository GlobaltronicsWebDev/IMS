 <!-- Sidebar -->
 <ul class="navbar-nav sidebar sidebar-dark accordion managersidebar" style="background-color: #166ccf" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <span class="mb-2"></span>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        {{-- <div class="sidebar-brand-icon">
            <i class="fas fa-solid fa-warehouse"></i>
        </div>
        <div class="sidebar-brand-text mx-3">IMS</div> --}}
        <img class="img-fluid mt-4" src="/uploads/global_white_name.png" alt="" style="width:80%; height:auto; margin-bottom:8px;">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-2 mt-4">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        {{ Request::is('manager/category*') ? 'show' : '' }}" id="categories" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-duotone fa-tags"></i>
            <span>Categories</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options:</h6>
                <a class="collapse-item" href="{{ url('manager/category/create') }}">Add Category</a>
                <a class="collapse-item" href="{{ url('manager/category/') }}">View Categories</a>
            </div>
        </div>
    </li> --}}

    {{-- Categories --}}
    <li class="nav-item {{ Request::is('manager/category') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('manager/category') }}">
            <i class="fas fa-duotone fa-tags"></i>
            <span>Categories</span></a>
    </li>

    {{-- Brands --}}
    <li class="nav-item {{ Request::is('manager/brands') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('manager/brands') }}">
            <i class="fas fa-solid fa-registered"></i>
            <span>Brands</span></a>
            <div id="loaderIcon" class="spinner-grow text-primary" style="display:none" role="status">
                <span class="sr-only">Loading...</span>
            </div>
    </li>

    {{-- Inventory --}}
    <li class="nav-item {{ Request::is('manager/products') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('manager/products') }}">
            <i class="bi bi-boxes"></i>
            <span>Inventory</span></a>
    </li>

    {{-- Checkin --}}
    <li class="nav-item {{ Request::is('manager/checkins') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('manager/checkins') }}">
            <i class="bi bi-arrow-left-circle"></i>
            <span>Check-ins</span></a>
    </li>

    {{-- Checkouts --}}
    {{-- <li class="nav-item {{ Request::is('manager/orders') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('manager/orders') }}">
            <i class="bi bi-arrow-right-circle"></i>
            <span>Checkouts</span></a>
    </li> --}}



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCheckout"
            aria-expanded="true" aria-controls="collapseCheckout">
            <i class="bi bi-arrow-right-circle"></i>
            <span>Checkouts</span>
        </a>
        <div id="collapseCheckout" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Checkout Options:</h6>
                <a class="collapse-item" href="{{ url('manager/orders') }}">Checkouts</a>
                <a class="collapse-item" href="{{ url('manager/returns') }}">Returns</a>
                <a class="collapse-item" href="{{ url('manager/borrowers') }}">Borrow Items</a>
                <a class="collapse-item" href="{{ url('manager/purchasereturns') }}">Purchase Returns</a>

            </div>
        </div>
    </li>

    <!-- Divider -->

    <!-- Heading -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
