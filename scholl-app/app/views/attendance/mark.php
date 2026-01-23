<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Presence</h1>
            <p><?= htmlspecialchars($class['name'] ?? '') ?></p>
            <a class="btn btn-secondary" href="/classes/manage?id=<?= (int) $class['id'] ?>">Retour</a>
                    <a class="btn btn-secondary" href="/teacher/dashboard">Dashboard</a>
        </header>

        <form class="form-card" action="/attendance/save" method="POST">
            <input type="hidden" name="class_id" value="<?= (int) $class['id'] ?>">

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" class="form-control" value="<?= htmlspecialchars($date) ?>">
            </div>

            <?php if (!empty($students)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Etudiant</th>
                            <th>Present</th>
                            <th>Absent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <?php $current = $statuses[(int) $student['id']] ?? 'present'; ?>
                            <tr>
                                <td><?= htmlspecialchars($student['name']) ?></td>
                                <td>
                                    <input type="radio"
                                           name="status[<?= (int) $student['id'] ?>]"
                                           value="present" <?= $current === 'present' ? 'checked' : '' ?>>
                                </td>
                                <td>
                                    <input type="radio"
                                           name="status[<?= (int) $student['id'] ?>]"
                                           value="absent" <?= $current === 'absent' ? 'checked' : '' ?>>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            <?php else: ?>
                <p>Aucun etudiant dans cette classe.</p>
            <?php endif; ?>
        </form>
    </main>
</body>
</html>
