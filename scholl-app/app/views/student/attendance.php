<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma presence</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Ma presence</h1>
            <p>Taux de presence: <?= htmlspecialchars((string) $percentage) ?>%</p>
            <a class="btn btn-secondary" href="/student/dashboard">Retour</a>
        </header>

        <div class="form-card">
            <?php if (!empty($records)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Classe</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $record): ?>
                            <tr>
                                <td><?= htmlspecialchars($record['date']) ?></td>
                                <td><?= htmlspecialchars($record['class_name']) ?></td>
                                <td><?= htmlspecialchars($record['status']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun historique de presence.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
