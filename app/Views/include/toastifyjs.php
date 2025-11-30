<?php

        $message = (session()->success != '') ? session()->success : session()->failed;
        $messageColor = (session()->failed != '') ? 'red' : 'green';
        if (!empty($message)): ?>
            <script src="<?= base_url('public/vendors/toastify/toastify.js'); ?>"></script>

            <script>
                Toastify({
                    text: "<?= $message; ?>",
                    duration: 5000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    backgroundColor: '<?= $messageColor; ?>',
                    onClick: function () { } // Callback after click
                }).showToast();
            </script>
            <?php session()->remove('failed');
            session()->remove('success'); ?>
        <?php endif; ?>