<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mise à jour de votre demande</title>
</head>

<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f5f5f5;">

    <!-- Table principale -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f5f5f5">
        <tr>
            <td align="center" style="padding:20px;">

                <!-- Conteneur 600px -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff"
                    style="border-collapse:collapse;">

                    <!-- Header -->
                    <tr>
                        <td bgcolor="#f8f9fa" align="center" style="padding:20px; border-bottom:3px solid #f59e0b;">
                            <h1 style="color:#333; margin:0; font-size:24px;">{{ config('app.name', 'Centre de
                                Formation') }}</h1>
                        </td>
                    </tr>

                    <!-- Contenu -->
                    <tr>
                        <td style="padding:30px 20px;">

                            <h2 style="color:#333; margin-top:0; font-size:20px;">Mise à jour de votre demande de
                                formation</h2>

                            <p style="color:#333; margin-bottom:20px; font-size:16px;">Bonjour <strong>{{
                                    $demande->nom_complet }}</strong>,</p>

                            <p style="color:#333; margin-bottom:20px; font-size:16px;">Le statut de votre demande de
                                formation a été mis à jour.</p>

                            <!-- Statut -->
                            <table width="100%" cellpadding="15" cellspacing="0" border="0" bgcolor="#f0f0f0"
                                style="margin:20px 0; border-left:4px solid #007bff;">
                                <tr>
                                    <td>
                                        <h3 style="color:#333; margin-top:0; font-size:18px;">Statut mis à jour</h3>
                                        <p style="color:#333; margin:5px 0;"><strong>Ancien statut :</strong> {{
                                            $ancienStatut }}</p>
                                        <p style="color:#333; margin:5px 0;"><strong>Nouveau statut :</strong> {{
                                            $nouveauStatut }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Détails -->
                            <table width="100%" cellpadding="15" cellspacing="0" border="0" bgcolor="#f9f9f9"
                                style="margin:15px 0; border:1px solid #eee;">
                                <tr>
                                    <td>
                                        <h3 style="color:#333; margin-top:0; font-size:18px;">Détails de votre demande :
                                        </h3>
                                        <p style="color:#333; margin:8px 0;"><strong>Formation :</strong> {{
                                            $demande->formation_label }}</p>
                                        <p style="color:#333; margin:8px 0;"><strong>Date de demande :</strong> {{
                                            $demande->created_at->format('d/m/Y') }}</p>
                                        <p style="color:#333; margin:8px 0;"><strong>Référence :</strong> DEM-{{
                                            $demande->id }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Notes admin -->
                            @if($demande->notes_admin)
                            <table width="100%" cellpadding="15" cellspacing="0" border="0" bgcolor="#fff8e1"
                                style="margin:15px 0; border-left:4px solid #f59e0b;">
                                <tr>
                                    <td>
                                        <h3 style="color:#333; margin-top:0; font-size:18px;">Message de notre équipe :
                                        </h3>
                                        <p style="color:#666; margin:0;">{{ $demande->notes_admin }}</p>
                                    </td>
                                </tr>
                            </table>
                            @endif

                            <!-- Message statut -->
                            @if($demande->statut == 'traite')
                            <table width="100%" cellpadding="15" cellspacing="0" border="0" bgcolor="#d4edda"
                                style="margin:20px 0; border:1px solid #c3e6cb;">
                                <tr>
                                    <td>
                                        <p style="color:#155724; margin:0; font-weight:bold;">Votre demande a été
                                            traitée avec succès. Nous vous contacterons prochainement pour la suite du
                                            processus.</p>
                                    </td>
                                </tr>
                            </table>
                            @elseif($demande->statut == 'en_cours')
                            <table width="100%" cellpadding="15" cellspacing="0" border="0" bgcolor="#fff3cd"
                                style="margin:20px 0; border:1px solid #ffeaa7;">
                                <tr>
                                    <td>
                                        <p style="color:#856404; margin:0; font-weight:bold;">Votre demande est en cours
                                            de traitement. Notre équipe l'examine et vous répondra dans les plus brefs
                                            délais.</p>
                                    </td>
                                </tr>
                            </table>
                            @elseif($demande->statut == 'annule')
                            <table width="100%" cellpadding="15" cellspacing="0" border="0" bgcolor="#f8d7da"
                                style="margin:20px 0; border:1px solid #f5c6cb;">
                                <tr>
                                    <td>
                                        <p style="color:#721c24; margin:0; font-weight:bold;">Votre demande a été
                                            annulée. Pour plus d'informations, n'hésitez pas à nous contacter.</p>
                                    </td>
                                </tr>
                            </table>
                            @endif

                            <!-- Contact -->
                            <table width="100%" cellpadding="15" cellspacing="0" border="0" bgcolor="#f8f9fa"
                                style="margin:25px 0;">
                                <tr>
                                    <td>
                                        <h3 style="color:#333; margin-top:0; font-size:18px;">Pour toute question :</h3>
                                        <p style="color:#333; margin:5px 0;">Email : {{ config('mail.from.address',
                                            'contact@formation.com') }}</p>
                                        <p style="color:#333; margin:5px 0;">Téléphone : {{ config('app.phone', '01 23
                                            45 67 89') }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Bouton -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ config('app.url') }}"
                                            style="display:inline-block; background-color:#f59e0b; color:white; padding:12px 24px; text-decoration:none; border-radius:5px; font-weight:bold;">
                                            Visiter notre site web
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td bgcolor="#f8f9fa" style="padding:20px; border-top:1px solid #dee2e6;" align="center">
                            <p style="color:#666; margin:5px 0; font-size:12px;">&copy; {{ date('Y') }} {{
                                config('app.name', 'Centre de Formation') }}</p>
                            <p style="color:#666; margin:5px 0; font-size:12px;">Cet email est envoyé automatiquement.
                            </p>
                            <p style="color:#999; margin:5px 0; font-size:11px;">Si vous n'êtes pas à l'origine de cette
                                demande, veuillez ignorer cet email.</p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
