<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soumettre un travail</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Soumettre un travail</h1>
            <p><?= htmlspecialchars($work['title'] ?? '') ?></p>
            <a class="btn btn-secondary" href="/student/works">Retour</a>
        </header>

        <form class="form-card" action="/student/works/submit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="work_id" value="<?= (int) $work['id'] ?>">

            <div class="form-group">
                <label for="content">Texte (optionnel)</label>
                <textarea id="content" name="content" class="form-control" rows="6"><?= htmlspecialchars($submission['content'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="attachment">Fichier (optionnel)</label>
                <input type="file" id="attachment" name="attachment" class="form-control">
                <?php if (!empty($submission['file_path'])): ?>
                    <p>Fichier actuel: <a href="<?= htmlspecialchars($submission['file_path']) ?>" target="_blank">Voir</a></p>
                <?php endif; ?>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </main>
</body>
</html>
