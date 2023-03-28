<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="author" content="KalikaShop Team">

    <!-- Custom fonts for this template-->
    <link rel="shortcut icon" href="{{ asset('uploads/global_blue1.png') }}">
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/spinner.css') }}" rel="stylesheet">


    {{-- Boostrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    @livewireStyles
</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="loader"></div>
        {{--  Sidebar --}}
        @include('layouts.inc.manager.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <div class="loader"></div>
                {{-- Topbar --}}
                @include('layouts.inc.manager.navbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')
                </div>
            </div>

        </div>

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('admin/js/spinner.js') }}"></script>
    <script src="{{ asset('admin/js/spinner.js') }}"></script>


    @yield('scripts')
    @livewireScripts
    @stack('script')
    <script type="text/javascript">
        var i = 0;
        $("#add").click(function() {
            ++i;

            $("#dynamicTable").append('<tr><td><input type="text" name="addmore[' + i +
                '][sku]" placeholder="Stock Keeping Unit" class="form-control"/></td><td><input type="text" name="addmore[' +
                i +
                '][productcode]" placeholder="Product Code" class="form-control"/></td><td><input type="text" name="addmore[' +
                i +
                '][model]" placeholder="Model" class="form-control"/></td><td><input type="text" name="addmore[' +
                i +
                '][quantity]" placeholder="Quantity" class="form-control"/></td><td><select name="addmore[' +
                i +
                '][uom]" class="form-control"><option value="Units">Unit/s</option><option value="Panels">Panel/s</option><option value="Pcs">Pc/s</option></select></td><td><input type="text" name="addmore[' +
                i +
                '][itemdescription]" placeholder="Description" class="form-control"/></td><td><input type="text" name="addmore[' +
                i +
                '][serialnumber]" placeholder="Serial No." class="form-control"/></td><td class="border border-white"><button type="button" class="btn btn-danger btn-sm remove-tr" title="Remove item"><i class="bi bi-x-circle"></i></button></td></tr>'
            );
        });

        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    </script>


</body>
</html>
