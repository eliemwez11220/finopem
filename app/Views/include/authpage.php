

<?php
    $message = (session()->success != '') ? session()->success : session()->failed;
    $messageIcon = (session()->failed != '') ? 'error' : 'success';
    $not_title = (isset($title)) ? $title : 'Warning';
    $messageColor = (session()->failed != '') ? 'red' : 'green';
    if (!empty($message)): ?>
        <script src="<?= base_url('public/vendors/sweetalert2/js/sweetalert2.js'); ?>"></script>
        <script>
            let timerInterval;
            Swal.fire({
                position: 'bottom-end',
                title: '<?= $not_title; ?>',
                text: '<?= $message; ?>',
                html: '<span style="color:<?= $messageColor; ?>" class="h5"><i class="<?= $messageIcon; ?>"></i><?= $message; ?></span>,',
                showConfirmButton: true,
                confirmButtonColor: '#ef6603',
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            });
        </script>
        <?php session()->remove('failed');
        session()->remove('success'); ?>
    <?php endif; ?>