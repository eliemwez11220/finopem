function showPass() {
    let inputs = document.getElementsByClassName('password');
    let icon = document.getElementById('eyepass');
    let passmsg = document.getElementById('passmsg');
    for (const input of inputs) {
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.add('fa-eye-slash');
            icon.classList.remove('fa-eye');
        } else if (input.type === 'text') {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
}
function hideReporting() {

    let icon = document.getElementById('hide_status');
    let passmsg = document.getElementById('hide_info');

    $(document).ready(function () {

        let urlBase = "<?= base_url('reporting-hidden'); ?>";

        $.ajax({
            url: urlBase,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                //console.log(data);

                location.reload(); //RELAOD PAGE FOR AJAX REQUEST
                //icon.classList.remove('fa-eye-slash');
                /// icon.classList.add('fa-eye');
                // passmsg.innerHTML = "Afficher le récapitulatif";
            }
        });
    });
}

$(document).ready(function () {
    $('#btn_offcanvas_help_customers').on('click', function () {
        $('#offcanvas_help_customers').toggleClass('open');
    });
});

$(document).ready(function () {

    $('#composemessage').summernote();

    $('#floatingSelect2').select2({
        theme: 'bootstrap-5'
    });

    // Adjust the padding for the Select2 dropdown when it opens
    $('#floatingSelect2').on('select2:open', function () {
        $(this).parent().find('.select2-selection').css('padding', '0.75rem 1rem');
    });

    // Reset the padding for the Select2 dropdown when it closes
    $('#floatingSelect2').on('select2:close', function () {
        $(this).parent().find('.select2-selection').css('padding', '0.75rem 1rem');
    });
});