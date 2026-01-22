<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes notes</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Mes notes</h1>
            <a class="btn btn-secondary" href="/student/dashboard">Retour</a>
        </header>

        <div class="form-card">
            <?php if (!empty($grades)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Travail</th>
                            <th>Note</th>
                            <th>Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($grades as $grade): ?>
                            <tr>
                                <td><?= htmlspecialchars($grade['title']) ?></td>
                                <td><?= htmlspecialchars($grade['grade'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($grade['comment'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune note disponible.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
