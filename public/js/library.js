//datetimepicker manage
$(function () {
     //Manage tooltip in page
    $('[data-toggle="tooltip"]').tooltip()
    //Add text editor
   // $('#compose-textarea').summernote();
   // $('#composemessage').summernote();
    //Initialize Select2 Elements
    $('.select2').select2();
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
    //Money Euro
    $('[data-mask]').inputmask();
    $('[data-mask]').inputmask();
    $("#francs").inputmask({ alias : "currency", prefix: 'FC ' });
    $(".francs").inputmask({ alias : "currency", prefix: 'FC ' });
    //Date range picker
    //$('#reservation').daterangepicker();
    //Date range picker with time picker
   /* $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY hh:mm A'
        }
    });
    //Date range picker
    $('#date_format_abrege').datetimepicker({
        format: 'YYYY/MM/DD'
    }); //Date range picker
    $('#date_debut_annee').datetimepicker({
        format: 'YYYY/MM/DD'
    });
    //Date range picker
    $('#date_fin_annee').datetimepicker({
        format: 'YYYY/MM/DD'
    });
    //Timepicker
    $('#timepickerMatin').datetimepicker({
        format: 'LT'
    });
    //Timepicker
    $('#timepickerSoir').datetimepicker({
        format: 'LT'
    });*/
    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
});