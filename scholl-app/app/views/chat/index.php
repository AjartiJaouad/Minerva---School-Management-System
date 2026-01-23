<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat de classe</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Chat de classe</h1>
            <a class="btn btn-secondary" href="<?= htmlspecialchars($dashboardUrl) ?>">Dashboard</a>
        </header>

        <div class="form-card">
            <?php if (!empty($classes)): ?>
                <div class="activity-list">
                    <?php foreach ($classes as $classe): ?>
                        <div class="activity-item">
                            <div class="activity-details">
                                <p><strong><?= htmlspecialchars($classe['name']) ?></strong></p>
                                <p class="activity-time">Chat de la classe</p>
                            </div>
                            <a class="card-link" href="/chat/view?class_id=<?= (int) $classe['id'] ?>">Ouvrir</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Aucune classe disponible.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
