<!-- JAVASCRIPT -->
{{--<script src="{{ asset('/') }}assets/libs/jquery/jquery.min.js"></script>--}}
<script src="{{ asset('assets/js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('assets/js/jquery.form.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<!-- form advanced init -->
<script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.js') }}"></script>
<!-- Magnific-popup js -->
<script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<!-- Extra Scripts -->
@yield('extra-script')
<!-- App js -->
<!--tinymce js-->
<script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>

<!-- Summernote js -->
<script src="{{ asset('assets/libs/summernote/summernote-bs4.min.js') }}"></script>

<!-- init js -->
<script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>

<!-- toastr plugin -->
<script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>

<!-- toastr init -->
<script src="{{ asset('assets/js/pages/toastr.init.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>
@yield('script')
