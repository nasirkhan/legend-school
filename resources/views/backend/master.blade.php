<!doctype html>
<html lang="en">
@include('backend.includes.head-tag')
<body data-sidebar="dark">
@include('sweetalert::alert')
<!-- Begin page -->
<div id="layout-wrapper">
    <!--Top Bar-->
    @include('backend.includes.top-bar.top-bar')

    <!--Left Sidebar-->
    @include('backend.includes.side-bar.vertical-menu-3')


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @include('backend.includes.page-title')
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        {{--Modal--}}
        @include('backend.includes.modal')
        @include('backend.includes.loader')
        @include('backend.includes.footer')
    </div>
    <!-- end main content-->
</div>
    <!-- Right Sidebar -->
    @include('backend.includes.side-bar.right-bar')
    @include('backend.includes.bottom-scripts')
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
    @yield('special-js')

@include('includes.session-script')
</body>
</html>
