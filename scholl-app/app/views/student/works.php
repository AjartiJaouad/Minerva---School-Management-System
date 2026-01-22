<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes travaux</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Mes travaux</h1>
            <a class="btn btn-secondary" href="/student/dashboard">Retour</a>
        </header>

        <div class="form-card">
            <?php if (!empty($works)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Classe</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($works as $work): ?>
                            <tr>
                                <td><?= htmlspecialchars($work['title']) ?></td>
                                <td><?= htmlspecialchars($work['class_name']) ?></td>
                                <td><?= htmlspecialchars($work['status']) ?></td>
                                <td>
                                    <a class="btn btn-primary" href="/student/works/submit?id=<?= (int) $work['id'] ?>">
                                        <?= $work['status'] === 'submitted' ? 'Voir' : 'Soumettre' ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun travail assigne pour le moment.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
