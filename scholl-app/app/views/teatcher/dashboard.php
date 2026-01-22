<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant</title>
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <style>
        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn-logout {
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="header">
            <h1>Bienvenue, Professeur <?= htmlspecialchars($_SESSION['nom'] ?? 'Enseignant') ?> 👋</h1>
            <a href="/logout" class="btn-logout">Déconnexion</a>
        </div>

        <div class="content">
            <h3>Vos cours</h3>
            <p>Espace enseignant en cours de construction...</p>
        </div>
    </div>
</body>

</html>