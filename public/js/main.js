jQuery(document).ready(function () {
    //ADD PLACEHOLDER ON SELECT2 BOX ON SEARCH
    $('.select2').select2().on('select2:open', function (e) {
        $('.select2-search__field').attr('placeholder', 'Recherche ...');
    })
    //Enable multiple selection checkbox
    $("#select_alls").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('input[readonly]').click(function () {
        $(this).removeAttr('readonly');
      });
      
    //enable add new element in  option
    $('seclect').on('change', function () {
        $select_new = $(this).val();
        if ($select_new === 'new')
            $('#inputnewitemshow').slideDown();
        else
            $('#inputnewitemshow').slideUp();
    });

    $('form').attr('autocomplete', 'off');
    $('input').addClass('printoff bg-light'); // add class to all input to change background
    $('label').addClass('printoff'); //add classe to all label do not print
    $('button').addClass('printoff'); //add classe to all label do not print
    
    //CALCULATEUR DE PRIX SUR PAIEMENT FRAIS -->
    let solde = null;
    $('#montant_versement_usd').keyup(function () {
        let montant_dollars_verse = $(this).val();
        if (montant_dollars_verse !== '') {
            solde = montant_dollars_verse * $('#taux_journalier').val();
            $('#solde_dollars').val(solde);
        }
    });
});
/*
$(document).ready(function() {
$('#ddd').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'print',
            text: 'Print',
            customize: function (win) {
                // Add custom header content
                $(win.document.body)
                    .prepend(
                        '<div style="text-align: center; margin-bottom: 20px;">' +
                        '<h1>Company Name</h1>' +
                        '<p>Company Address</p>' +
                        '<p>Contact Information</p>' +
                        '</div>'
                    );

                // Optional: Add custom footer content
                $(win.document.body).append(
                    '<div style="text-align: center; margin-top: 20px;">' +
                    '<p>Footer Information</p>' +
                    '</div>'
                );

                // Add page numbers dynamically
                var css = '@page { size: auto; margin: 20mm; }';
                css += '@media print { .page-number { position: fixed; bottom: 0; right: 5px; font-size: 12px; } }';
                var style = document.createElement('style');
                style.type = 'text/css';
                style.media = 'print';
                style.appendChild(document.createTextNode(css));
                $(win.document.head).append(style);

                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.innerHTML = `
                    (function() {
                        var body = document.body;
                        var html = document.documentElement;
                        var height = Math.max( body.scrollHeight, body.offsetHeight, 
                                              html.clientHeight, html.scrollHeight, html.offsetHeight );
                        var pages = Math.ceil(height / window.innerHeight);
                        for (var i = 0; i <= pages; i++) {
                            var pageNumber = document.createElement('div');
                            pageNumber.className = 'page-number';
                            pageNumber.innerHTML = ' ' + i + ' / ' + pages;
                            body.appendChild(pageNumber);
                            if (i < pages) {
                                body.appendChild(document.createElement('div')).style.pageBreakAfter = 'always';
                            }
                        }
                    })();
                `;
                $(win.document.head).append(script);
            }
        }
    ]
});
});

$('#datatablesReporting').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'print',
            text: 'Print',
            customize: function (win) {
                // Add custom header content
                $(win.document.body)
                    .prepend(
                        '<div style="text-align: center; margin-bottom: 20px;">' +
                        '<h1>Company Name</h1>' +
                        '<p>Company Address</p>' +
                        '<p>Contact Information</p>' +
                        '</div>'
                    );

                // Optional: Add custom footer content
                $(win.document.body).append(
                    '<div style="text-align: center; margin-top: 20px;">' +
                    '<p>Footer Information</p>' +
                    '</div>'
                );

                // Add CSS for page numbers
                var css = '@page { size: auto; margin: 20mm; }';
                css += '@media print { body { counter-reset: page; }';
                css += ' .page-number:after { counter-increment: page; content: "Page " counter(page); position: fixed; bottom: 0; right: 0; font-size: 12px; }';
                css += '}';
                var style = document.createElement('style');
                style.type = 'text/css';
                style.media = 'print';
                style.appendChild(document.createTextNode(css));
                $(win.document.head).append(style);

                // Add page number container
                $(win.document.body).append('<div class="page-number"></div>');
            }
        }
    ]
});
});*/