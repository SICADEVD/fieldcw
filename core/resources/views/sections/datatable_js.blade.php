<!-- Datatables -->
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
{{-- <script src="{{ asset('assets/vendor/datatables/dataTables.responsive.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/vendor/datatables/responsive.bootstrap.min.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/buttons.server-side.js') }}"></script>
{!! $dataTable->scripts() !!}

<script>
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "inherit" );
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "auto" );
    })
</script>

@include('sections.daterange_js')