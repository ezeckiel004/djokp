<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #000;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            background-image:
                radial-gradient(circle at 20% 30%, rgba(202, 162, 77, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 80% 70%, rgba(202, 162, 77, 0.1) 0%, transparent 20%),
                linear-gradient(to bottom right, #0a0a0a, #1a1a1a);
        }

        .maintenance-container {
            max-width: 800px;
            width: 100%;
            padding: 50px 40px;
            border-radius: 16px;
            background: rgba(20, 20, 20, 0.85);
            backdrop-filter: blur(15px);
            border: 2px solid #caa24d;
            box-shadow:
                0 25px 50px rgba(202, 162, 77, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .maintenance-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #caa24d, #e6b85c, #caa24d);
        }

        .logo-maintenance {
            margin-bottom: 40px;
            text-align: center;
        }

        .logo-maintenance img {
            max-width: 200px;
            height: auto;
            filter: drop-shadow(0 5px 15px rgba(202, 162, 77, 0.3));
        }

        .maintenance-icon {
            font-size: 100px;
            color: #caa24d;
            margin-bottom: 30px;
            animation: wrench 3s ease-in-out infinite;
            text-shadow: 0 5px 15px rgba(202, 162, 77, 0.4);
        }

        @keyframes wrench {

            0%,
            100% {
                transform: rotate(0deg);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: rotate(15deg);
            }

            20%,
            40%,
            60%,
            80% {
                transform: rotate(-15deg);
            }
        }

        h1 {
            color: #caa24d;
            font-size: 3.2rem;
            margin-bottom: 20px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            background: linear-gradient(to right, #caa24d, #e6b85c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 2px 10px rgba(202, 162, 77, 0.2);
        }

        .subtitle {
            font-size: 1.6rem;
            color: #fff;
            margin-bottom: 30px;
            font-weight: 400;
            opacity: 0.95;
            line-height: 1.4;
        }

        .urgent-alert {
            background: linear-gradient(135deg, rgba(202, 162, 77, 0.15), rgba(202, 162, 77, 0.05));
            border: 2px solid #caa24d;
            padding: 25px;
            margin: 40px 0;
            border-radius: 12px;
            position: relative;
            animation: pulseBorder 2s infinite;
        }

        @keyframes pulseBorder {

            0%,
            100% {
                border-color: rgba(202, 162, 77, 0.8);
            }

            50% {
                border-color: rgba(202, 162, 77, 1);
            }
        }

        .urgent-alert h2 {
            color: #caa24d;
            font-size: 1.8rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .urgent-alert h2 i {
            font-size: 2rem;
        }

        .contact-info {
            text-align: center;
            margin: 30px 0;
            padding: 25px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .contact-info p {
            font-size: 1.3rem;
            line-height: 1.6;
            margin-bottom: 15px;
            color: #fff;
        }

        .company-info {
            color: #caa24d !important;
            font-weight: 700;
            font-size: 1.4rem !important;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .contact-details {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 25px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            font-size: 1.2rem;
            color: #ccc;
        }

        .contact-item i {
            color: #caa24d;
            font-size: 1.4rem;
            width: 30px;
            text-align: center;
        }

        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 193, 7, 0.1);
            padding: 8px 20px;
            border-radius: 50px;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #ffc107;
        }

        .status-dot {
            width: 12px;
            height: 12px;
            background: #ffc107;
            border-radius: 50%;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        .back-soon {
            margin-top: 40px;
            font-size: 1.1rem;
            color: #aaa;
            font-style: italic;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .tech-details {
            margin-top: 30px;
            padding: 15px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            font-size: 0.9rem;
            color: #888;
            font-family: monospace;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .error-code {
            font-size: 0.8rem;
            color: #666;
            margin-top: 20px;
            letter-spacing: 1px;
        }

        @media (max-width: 768px) {
            .maintenance-container {
                padding: 30px 20px;
                margin: 10px;
            }

            h1 {
                font-size: 2.2rem;
            }

            .subtitle {
                font-size: 1.3rem;
            }

            .maintenance-icon {
                font-size: 70px;
            }

            .contact-item {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }

            .urgent-alert {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.8rem;
            }

            .subtitle {
                font-size: 1.1rem;
            }

            .company-info {
                font-size: 1.2rem !important;
            }

            .maintenance-container {
                padding: 25px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="maintenance-container">
        <div class="logo-maintenance">
            <img src="{{ asset('DP2.webp') }}" alt="DJOK PRESTIGE" onerror="this.style.display='none'">
        </div>

        <div class="maintenance-icon">
            <i class="fas fa-tools"></i>
        </div>

        <h1>MAINTENANCE EN COURS</h1>

        <div class="subtitle">
            Le site est actuellement en maintenance technique
        </div>

        <div class="urgent-alert">
            <h2>
                <i class="fas fa-exclamation-triangle"></i>
                VEUILLEZ CONTACTER LE SERVICE TECHNIQUE
            </h2>
            <div class="contact-info">
                <p>L'entreprise en charge de la maintenance est</p>
                <p class="company-info">GROUPE VIBECRO</p>

                <div class="contact-details">
                    <div class="contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <span>Téléphone support : <strong>06.99.16.44.55</strong></span>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>Email : <strong>support@djokprestige.com</strong></span>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <span>Support technique disponible 24h/24</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="status-indicator">
            <div class="status-dot"></div>
            <span>MAINTENANCE TECHNIQUE EN COURS</span>
        </div>

        <div class="back-soon">
            <p>Nous travaillons à rétablir le service au plus vite.</p>
            <p>Veuillez nous excuser pour la gêne occasionnée.</p>
        </div>

        <div class="tech-details">
            <p><i class="fas fa-info-circle"></i> Intervention technique nécessaire pour améliorer votre expérience.</p>
        </div>

        <div class="error-code">
            Référence : MAINT-{{ date('Ymd-His') }}
        </div>
    </div>

    <script>
        // Mettre à jour l'heure toutes les minutes
        function updateTimestamp() {
            const now = new Date();
            const timestamp = now.toISOString().slice(0,19).replace('T', ' ');
            const element = document.querySelector('.error-code');
            if (element) {
                element.innerHTML = `Référence : MAINT-${now.getFullYear()}${String(now.getMonth()+1).padStart(2,'0')}${String(now.getDate()).padStart(2,'0')}-${String(now.getHours()).padStart(2,'0')}${String(now.getMinutes()).padStart(2,'0')}${String(now.getSeconds()).padStart(2,'0')}`;
            }
        }

        // Mettre à jour immédiatement puis toutes les minutes
        updateTimestamp();
        setInterval(updateTimestamp, 60000);

        // Animation supplémentaire pour le logo
        document.addEventListener('DOMContentLoaded', function() {
            const logo = document.querySelector('.logo-maintenance img');
            if (logo) {
                setInterval(() => {
                    logo.style.filter = "drop-shadow(0 5px 15px rgba(202, 162, 77, 0.3)) brightness(1.1)";
                    setTimeout(() => {
                        logo.style.filter = "drop-shadow(0 5px 20px rgba(202, 162, 77, 0.5)) brightness(1.2)";
                    }, 500);
                }, 2000);
            }
        });
    </script>
</body>

</html>
