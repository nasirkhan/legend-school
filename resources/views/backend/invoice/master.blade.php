@include('backend.invoice.head')
<div class="container bg-white pt-4">
    @include('backend.invoice.header')
    <div class="row">
        <div class="col-12">
            <table class="paging" width="100%">
                <thead>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>
                        @yield('body')
                    </td>
                </tr>
                </tbody>

                <tfoot>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @include('backend.invoice.footer')
    @include('backend.invoice.print-box')
</div>
</body>
</html>

