<script src="{{asset('../../admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('../../admin/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('../../admin/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- apps -->
<script src="{{asset('../../admin/dist/js/app.min.js')}}"></script>
<script src="{{asset('../../admin/dist/js/app.init.js')}}"></script>
<script src="{{asset('../../admin/dist/js/app-style-switcher.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('../../admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('../../admin/assets/extra-libs/sparkline/sparkline.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('../../admin/dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('../../admin/dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('../../admin/dist/js/custom.min.js')}}"></script>
<!--This page JavaScript -->
<!--chartis chart-->
<script src="{{asset('../../admin/assets/libs/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('../../admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}">
</script>
<!--c3 charts -->
<script src="{{asset('../../admin/assets/extra-libs/c3/d3.min.js')}}"></script>
<script src="{{asset('../../admin/assets/extra-libs/c3/c3.min.js')}}"></script>
<script src="{{asset('../../admin/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('../../admin/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('../../admin/dist/js/pages/dashboards/dashboard1.j')}}s"></script>


<script src="{{asset('../../admin/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script src="{{asset('../../admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

<script src="{{asset('../../admin/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="{{asset('../../admin/dist/js/pages/datatable/datatable-advanced.init.js')}}"></script>

<script src="{{asset('../../admin/assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('../../admin/assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('../../admin/dist/js/pages/forms/select2/select2.init.js')}}"></script>
<script src="{{asset('../../admin/dist/js/pages/samplepages/jquery.PrintArea.js')}}"></script>
<script>
    $(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
</script>


