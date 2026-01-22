<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer un travail</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Creer un travail</h1>
            <a class="btn btn-secondary" href="/works">Retour</a>
        </header>

        <form class="form-card" action="/works/store" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="class_id">Classe</label>
                <select id="class_id" name="class_id" class="form-control" required>
                    <option value="">-- Selectionner une classe --</option>
                    <?php foreach ($classes as $classe): ?>
                        <option value="<?= (int) $classe['id'] ?>">
                            <?= htmlspecialchars($classe['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="attachment">Fichier joint (optionnel)</label>
                <input type="file" id="attachment" name="attachment" class="form-control">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Creer</button>
            </div>
        </form>
    </main>
</body>
</html>
