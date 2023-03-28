 <!-- Sidebar -->
 <!-- Sidebar -->
 <ul class="navbar-nav sidebar sidebar-dark accordion adminsidebar" style="background-color: #166ccf" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <span class="mb-2"></span>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin/dashboard') }}">
        {{-- <div class="sidebar-brand-icon">
            <i class="fas fa-solid fa-warehouse"></i>
        </div>
        <div class="sidebar-brand-text mx-3">IMS</div> --}}
        <img class="img-fluid mt-4" src="/uploads/global_white_name.png" alt="" style="width:80%; height:auto; margin-bottom:8px;">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 mt-4">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        {{ Request::is('admin/category*') ? 'show' : '' }}" id="categories" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-duotone fa-tags"></i>
            <span>Categories</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options:</h6>
                <a class="collapse-item" href="{{ url('admin/category/create') }}">Add Category</a>
                <a class="collapse-item" href="{{ url('admin/category/') }}">View Categories</a>
            </div>
        </div>
    </li> --}}

    {{-- Categories --}}
    <li class="nav-item {{ Request::is('admin/category') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/category') }}">
            <i class="fas fa-duotone fa-tags"></i>
            <span>Categories</span></a>
    </li>

    {{-- Brands --}}
    <li class="nav-item {{ Request::is('admin/brands') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/brands') }}">
            <i class="fas fa-solid fa-registered"></i>
            <span>Brands</span></a>
            <div id="loaderIcon" class="spinner-grow text-primary" style="display:none" role="status">
                <span class="sr-only">Loading...</span>
            </div>
    </li>

    {{-- Inventory --}}
    <li class="nav-item {{ Request::is('admin/products') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/products') }}">
            <i class="bi bi-boxes"></i>
            <span>Inventory</span></a>
    </li>

    {{-- Checkin --}}
    <li class="nav-item {{ Request::is('admin/checkins') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/checkins') }}">
            <i class="bi bi-arrow-left-circle"></i>
            <span>Check-ins</span></a>
    </li>

    {{-- Checkouts --}}
    {{-- <li class="nav-item {{ Request::is('admin/orders') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/orders') }}">
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
                <a class="collapse-item" href="{{ url('admin/orders') }}">Checkouts</a>
                <a class="collapse-item" href="{{ url('admin/returns') }}">Returns</a>
                <a class="collapse-item" href="{{ url('admin/borrowers') }}">Borrow Items</a>
                <a class="collapse-item" href="{{ url('admin/purchasereturns') }}">Purchase Returns</a>

            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

     <!-- Nav Item - User Management Collapse Menu -->
     <li class="nav-item {{ Request::is('admin/users') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/users') }}">
            <i class="fas fa-duotone fa-users"></i>
            <span>User Management</span></a>
    </li>
    <li class="nav-item {{ Request::is('admin/user-activity') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/user-activity') }}">
            <i class="fas fa-duotone fa-users"></i>
            <span>Activity Logs</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
