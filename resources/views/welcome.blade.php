<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Med</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="refresh" content="5;url={{ route('login') }}">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0f4c75, #3282b8);
            color: white;
            text-align: center;
        }

        .container {
            margin-top: 120px;
        }

        h1 {
            font-size: 50px;
            margin-bottom: 10px;
        }

        p {
            font-size: 20px;
            margin-bottom: 40px;
        }

        .card {
            background: rgba(255,255,255,0.1);
            padding: 30px;
            border-radius: 15px;
            width: 60%;
            margin: auto;
            backdrop-filter: blur(10px);
        }

        .btn {
            padding: 12px 25px;
            background: white;
            color: #0f4c75;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn:hover {
            background: #f1f1f1;
        }

        .features {
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h1>Gestion Med</h1>
        <p>Système intelligent de gestion médicale</p>

        <div class="features">
            ✔ Gestion des patients<br>
            ✔ Gestion des rendez-vous<br>
            ✔ Gestion du personnel médical<br>
            ✔ API sécurisée versionnée (V1)<br>
            ✔ Tableau de bord administrateur
        </div>

        <br><br>

        <a href="{{ route('login') }}" class="btn">Accéder au système</a>

        <p style="margin-top:20px;font-size:14px;">
            Redirection automatique dans 5 secondes...
        </p>
    </div>
</div>

</body>
</html>