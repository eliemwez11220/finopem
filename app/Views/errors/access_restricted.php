<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accès restreint - Magschool</title>
    <?php //$nonce = base64_encode(random_bytes(16)); ?>
    <link rel="icon" type="image/png" href="<?= base_url('public/img/logo/favicon.png'); ?>" />
    <!-- ========== All CSS files linkup ========= -->
    <style>
    body {
        background: #f7f9fc;
        font-family: 'Segoe UI', sans-serif;
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        text-align: center;
    }

    h1 {
        color: #e74c3c;
        margin-bottom: 10px;
    }

    .countdown-wrapper {
        position: relative;
        width: 200px;
        height: 200px;
        margin: 30px auto;
    }

    .circle {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: conic-gradient(#3498db 0deg, #eee 0deg);
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .circle span {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.8em;
        font-weight: bold;
        color: #ffffff;
        text-shadow: 0 0 6px rgba(0, 0, 0, 0.6);
        /* améliore la lisibilité */
        white-space: nowrap;
    }

    .box {
        background-color: #fff;
        border: 1px solid #ddd;
        display: inline-block;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .info {
        font-size: 1.2em;
        margin-top: 20px;
    }
    </style>

</head>

<body>
    <div class="box container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 offset-lg-3">
                <div class="auth-form-transparent bg-light text-white card-radius card shadow-lg">
                    <h1 class="text-center py-3">
                        <a href="<?= base_url(); ?>" class="font-weight-bold text-uppercase border border-danger">
                            <span class="badge bg-primary py-3 rounded-circle">
                                <img src="<?= base_url('public/img/logo/favicon.png'); ?>" alt="Logo" width="50"
                                    height="50">
                            </span>
                        </a>
                    </h1>
                </div>
            </div>
        </div>
        <h1>⏳ Accès restreint ⏳</h1>
        <p>Le système est actuellement fermé.</p>
        <p>Horaires d'accès : <strong>du lundi au samedi</strong>, de <strong>6h à 21h</strong>.</p>
        <p>Merci de votre compréhension !</p>


        <div class="countdown-wrapper">
            <div class="circle" id="progressCircle">
                <span id="timeLeft">00:00:00</span>
            </div>
        </div>

        <div class="info" id="countdown">
            Le système rouvrira dans :
        </div>
    </div>

    <script>
    const nextOpenTime = new Date("<?= esc($next_open_iso) ?>"); // heure serveur
    const circle = document.getElementById('progressCircle');
    const timeDisplay = document.getElementById('timeLeft');

    function updateCountdown() {
        const now = new Date();
        const total = nextOpenTime - now;

        if (total <= 0) {
            timeDisplay.textContent = "Ouvert !";
            circle.style.background = 'conic-gradient(#2ecc71 360deg, #eee 0deg)';
            return;
        }

        const totalSeconds = Math.floor(total / 1000);
        const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
        const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
        const seconds = String(totalSeconds % 60).padStart(2, '0');

        timeDisplay.textContent = `${hours}:${minutes}:${seconds}`;

        // Avancement circulaire
        const percent = 1 - (total / (1000 * 60 * 60 * 24)); // progress on 24h base
        const degrees = Math.floor(percent * 360);

        circle.style.background = `conic-gradient(#3498db ${degrees}deg, #eee 0deg)`;

        if (total <= 0) {
            document.getElementById("countdown").innerHTML = "Le système est maintenant ouvert.";
            return;
        }

        const hours2 = Math.floor((total / (1000 * 60 * 60)) % 24);
        const minutes2 = Math.floor((total / (1000 * 60)) % 60);
        const seconds2 = Math.floor((total / 1000) % 60);

        document.getElementById("countdown").innerHTML =
            `🕒 Le système rouvrira dans : <strong>${hours2}h ${minutes2}m ${seconds2}s</strong>`;

    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
    </script>
</body>

</html>