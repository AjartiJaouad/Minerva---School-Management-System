<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigner un travail</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Assigner un travail</h1>
            <p><?= htmlspecialchars($work['title'] ?? '') ?> - <?= htmlspecialchars($work['class_name'] ?? '') ?></p>
            <a class="btn btn-secondary" href="/works">Retour</a>
        </header>

        <?php if (!empty($students)): ?>
            <form class="form-card" action="/works/assign" method="POST">
                <input type="hidden" name="work_id" value="<?= (int) $work['id'] ?>">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Choisir</th>
                            <th>Nom</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <?php $checked = in_array((int) $student['id'], $assignedIds, true); ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="student_ids[]" value="<?= (int) $student['id'] ?>" <?= $checked ? 'checked' : '' ?>>
                                </td>
                                <td><?= htmlspecialchars($student['name']) ?></td>
                                <td><?= htmlspecialchars($student['email']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        <?php else: ?>
            <p>Aucun etudiant dans cette classe.</p>
        <?php endif; ?>
    </main>
</body>
</html>
