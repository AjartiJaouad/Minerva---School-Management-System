<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer une classe</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Creer une classe</h1>
            <p>Ajoutez une nouvelle classe a votre compte.</p>
                    <a class="btn btn-secondary" href="/teacher/dashboard">Dashboard</a>
        </header>

        <form action="/classes/store" method="POST" class="form-card">
            <div class="form-group">
                <label for="name">Nom de la classe</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-actions">
                <a class="btn btn-secondary" href="/classes">Annuler</a>
                <button type="submit" class="btn btn-primary">Creer</button>
            </div>
        </form>
    </main>
</body>
</html>
