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
        </header>

        <div class="form-card">
            <?php if (!empty($classes)): ?>
                <ul>
                    <?php foreach ($classes as $classe): ?>
                        <li>
                            <a href="/chat/view?class_id=<?= (int) $classe['id'] ?>">
                                <?= htmlspecialchars($classe['name']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucune classe disponible.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
