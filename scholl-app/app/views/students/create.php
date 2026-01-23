<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer un etudiant</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Creer un etudiant</h1>
            <a class="btn btn-secondary" href="/teacher/dashboard">Retour</a>
        </header>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="error-message"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="success-message"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form class="form-card" action="/students/store" method="POST">
            <div class="form-group">
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="class_id">Classe (optionnel)</label>
                <select id="class_id" name="class_id" class="form-control">
                    <option value="">-- Selectionner une classe --</option>
                    <?php foreach ($classes as $classe): ?>
                        <option value="<?= (int) $classe['id'] ?>">
                            <?= htmlspecialchars($classe['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Creer</button>
            </div>
        </form>
    </main>
</body>
</html>
