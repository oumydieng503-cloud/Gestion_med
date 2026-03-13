<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6fc; margin: 0; padding: 0; }
        .container { max-width: 580px; margin: 40px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .header { background: #4e73df; padding: 2rem; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 1.4rem; }
        .header p { color: rgba(255,255,255,0.75); margin: 0.5rem 0 0; font-size: 0.9rem; }
        .body { padding: 2rem; color: #2d3748; }
        .body h2 { font-size: 1.2rem; margin-bottom: 1rem; }
        .card { background: #f4f6fc; border-radius: 10px; padding: 1.25rem; margin: 1.5rem 0; }
        .card-row { display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e2e8f0; font-size: 0.9rem; }
        .card-row:last-child { border-bottom: none; }
        .card-row .label { color: #718096; }
        .card-row .value { font-weight: 600; color: #2d3748; }
        .badge { display: inline-block; background: #c6f6d5; color: #276749; padding: 0.3rem 0.85rem; border-radius: 100px; font-size: 0.8rem; font-weight: 600; }
        .footer { text-align: center; padding: 1.5rem; background: #f4f6fc; color: #a0aec0; font-size: 0.8rem; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🏥 MediCare</h1>
        <p>Votre espace santé en ligne</p>
    </div>
    <div class="body">
        <h2>Bonjour {{ $reservation->user->name }},</h2>
        <p>Votre rendez-vous a été <strong>confirmé</strong> par votre médecin. Voici le récapitulatif :</p>

        <div class="card">
            <div class="card-row">
                <span class="label">Service</span>
                <span class="value">{{ $reservation->service->nom }}</span>
            </div>
            <div class="card-row">
                <span class="label">Date</span>
                <span class="value">{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}</span>
            </div>
            <div class="card-row">
                <span class="label">Heure</span>
                <span class="value">{{ \Carbon\Carbon::parse($reservation->heure_reservation)->format('H:i') }}</span>
            </div>
            <div class="card-row">
                <span class="label">Statut</span>
                <span class="value"><span class="badge">✅ Confirmée</span></span>
            </div>
        </div>

        <p style="color: #718096; font-size: 0.9rem;">
            Merci de vous présenter 10 minutes avant l'heure de votre rendez-vous.
            En cas d'empêchement, pensez à annuler via votre espace patient.
        </p>
    </div>
    <div class="footer">
        © {{ date('Y') }} MediCare — Cet email a été envoyé automatiquement, merci de ne pas y répondre.
    </div>
</div>
</body>
</html>