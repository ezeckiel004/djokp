<!-- Footer -->
<footer class="footer">
    <div class="footer-grid">
        <!-- Logo -->
        <div class="footer-logo">
            <!-- Remplacez l'URL par le chemin de votre logo -->
            <img src="{{ asset('DP.png') }}" alt="DJOK PRESTIGE" />
        </div>

        <!-- Services -->
        <div>
            <h4>Services</h4>
            <ul>
                <li><a href="{{ route('location') }}">Location de véhicules</a></li>
                <li><a href="{{ route('reservation') }}">Aéroport / Gare</a></li>
                <li><a href="{{ route('reservation') }}">Mise à disposition</a></li>
                <li><a href="{{ route('reservation') }}">Longue distance</a></li>
                <li><a href="{{ route('conciergerie') }}">Conciergerie</a></li>
                <li><a href="{{ route('performance') }}">Nos Chiffres clefs VTC</a></li>
            </ul>
        </div>

        <!-- Formations -->
        <div>
            <h4>Nos Formations</h4>
            <ul>
                <li><a href="{{ route('cgv') }}">C.G.V</a></li>
                <li><a href="{{ route('cgu') }}">C.G.U</a></li>
                <li><a href="{{ route('mentions-legales') }}">Mentions légales</a></li>
                <li><a href="{{ route('rgpd') }}">R.G.P.D</a></li>
                <li><a href="{{ route('performance') }}">Indicateurs de performance</a></li>
                <li><a href="{{ route('reclamation') }}">Réclamation</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h4>Nous Contacter</h4>
            <p>Email: contact@djokprestige.com</p>
            <p>Téléphone: 06.99.16.44.55</p>
            <p>Lun–Sam : 9h – 19h</p>

            <!-- Certification -->
            <div style="margin-top: 20px; padding: 12px; background: #111; border-radius: 4px;">
                <p style="font-size: 12px; color: #caa24d; font-weight: 600;">Centre de formation certifié Qualiopi</p>
                <p style="font-size: 11px; color: #ccc; margin-top: 4px;">Agréé VTC par la Préfecture</p>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="copyright">
        Copyright –
        <a href="https://vibecro.com/" target="_blank" rel="noopener noreferrer"
            style="color: inherit; text-decoration: none; font-weight: 600;">
            VIBECRO-INC
        </a>
        {{ date('Y') }}
    </div>
</footer>

<style>
    /* ===== FOOTER STYLES ===== */
    .footer {
        background: #000;
        padding: 60px 8% 0;
        font-family: 'Montserrat', sans-serif;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr;
        gap: 50px;
        align-items: flex-start;
    }

    .footer-logo img {
        max-width: 260px;
    }

    .footer h4 {
        color: #caa24d;
        font-size: 18px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .footer ul {
        list-style: none;
    }

    .footer ul li {
        margin-bottom: 12px;
        font-size: 14px;
        color: #fff;
    }

    .footer ul li a {
        color: #fff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer ul li a:hover {
        color: #caa24d;
    }

    .footer p {
        font-size: 14px;
        margin-bottom: 12px;
        color: #fff;
    }

    .copyright {
        margin-top: 100px;
        background: #caa24d;
        color: #000;
        text-align: center;
        padding: 15px;
        font-size: 16px;
        font-weight: 500;
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
    }

    .copyright a {
        color: inherit;
        text-decoration: none;
        font-weight: 600;
        transition: opacity 0.3s ease;
    }

    .copyright a:hover {
        opacity: 0.8;
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {
        .footer-grid {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .footer-logo img {
            margin: 0 auto;
            display: block;
        }

        .copyright {
            font-size: 14px;
            padding: 12px 15px;
            margin-top: 60px;
        }
    }

    @media (max-width: 480px) {
        .copyright {
            font-size: 13px;
            padding: 10px 15px;
        }
    }
</style>
