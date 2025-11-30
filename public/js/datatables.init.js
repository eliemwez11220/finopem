(function ($) {
    'use strict';
    $(document).ready(function () {
        $('#datatablesReportingActions').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": false,
            "language": {
                "emptyTable": "Aucune donnée",
                "info": " _START_ à _END_ sur _TOTAL_ lignes(s)",
                "infoEmpty": "Affichage de 0 à 0 sur 0 ligne(s)",
                "infoFiltered": "(filtré de _MAX_ lignes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Affichage _MENU_ ",
                "loadingRecords": "Chargement encours...",
                "processing": "",
                "search": "Recherche:",
                "zeroRecords": "Aucune donnée correspondant au critère de recherche",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            },
            layout: {
                topStart: {
                    //, 'pdfHtml5'
                    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5']
                }
            } 
        });
        $('#datatablesReportingActions_length select').addClass('form-select form-control');
        $('#datatablesReportingActions_filter input').addClass('form-control bg-light text-dark mr-3');
        $('#datatablesReportingActions_wrapper .dataTables_filter').find('input').each(function () {
            const $this = $(this);
            $this.attr("placeholder", "Saisissez un critère ...");
        });

        $('#datatablesExample2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "language": {
                "emptyTable": "Aucune donnée",
                "info": "Affichage _START_ à _END_ sur _TOTAL_ enregistrement(s)",
                "infoEmpty": "Résultats de 0 à 0 sur 0 ligne(s)",
                "infoFiltered": "(filtré de _MAX_ lignes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Afficher _MENU_",
                "loadingRecords": "Chargement encours...",
                "processing": "",
                "search": "Recherche",
                "zeroRecords": "Aucune donnée répondant au critère de recherche",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            },
        });
        $('#datatablesExample2_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('#datatablesExample2_wrapper .dataTables_filter').find('input').each(function () {
            const $this = $(this);
            $this.attr("placeholder", "Saisissez un critère ...");
            $this.className("form-control form-control-lg");
        });

        $('.datatables').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "language": {
                "emptyTable": "Aucune donnée",
                "info": "Affichage _START_ à _END_ sur _TOTAL_ enregistrement(s)",
                "infoEmpty": "Résultats de 0 à 0 sur 0 ligne(s)",
                "infoFiltered": "(filtré de _MAX_ lignes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Afficher _MENU_",
                "loadingRecords": "Chargement encours...",
                "processing": "",
                "search": "Recherche",
                "zeroRecords": "Aucune donnée répondant au critère de recherche",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            },
        });
        $('.datatables_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('.datatables_wrapper .dataTables_filter').find('input').each(function () {
            const $this = $(this);
            $this.attr("placeholder", "Saisissez un critère ...");
            $this.className("form-control form-control-lg");
        });
    });
}(jQuery));
    