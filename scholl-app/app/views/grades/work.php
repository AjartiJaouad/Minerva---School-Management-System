<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noter les travaux</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Noter les travaux</h1>
            <p><?= htmlspecialchars($work['title'] ?? '') ?></p>
            <a class="btn btn-secondary" href="/works">Retour</a>
        </header>

        <div class="form-card">
            <?php if (!empty($submissions)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Etudiant</th>
                            <th>Soumission</th>
                            <th>Note</th>
                            <th>Commentaire</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($submissions as $submission): ?>
                            <?php $current = $grades[$submission['id']] ?? null; ?>
                            <tr>
                                <td><?= htmlspecialchars($submission['name']) ?></td>
                                <td>
                                    <?php if (!empty($submission['file_path'])): ?>
                                        <a href="<?= htmlspecialchars($submission['file_path']) ?>" target="_blank">Fichier</a>
                                    <?php endif; ?>
                                    <?php if (!empty($submission['content'])): ?>
                                        <div><?= htmlspecialchars($submission['content']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form action="/grades/save" method="POST">
                                        <input type="hidden" name="submission_id" value="<?= (int) $submission['id'] ?>">
                                        <input type="hidden" name="work_id" value="<?= (int) $work['id'] ?>">
                                        <input type="number" name="grade" class="form-control" min="0" max="20" step="0.1"
                                               value="<?= htmlspecialchars($current['grade'] ?? '') ?>" required>
                                </td>
                                <td>
                                        <input type="text" name="comment" class="form-control"
                                               value="<?= htmlspecialchars($current['comment'] ?? '') ?>">
                                </td>
                                <td>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune soumission pour ce travail.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
