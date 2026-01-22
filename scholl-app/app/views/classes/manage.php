<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerer classe</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Gerer la classe</h1>
            <p><?= htmlspecialchars($class['name'] ?? 'Classe') ?></p>
            <a class="btn btn-secondary" href="/classes">Retour</a>
            <a class="btn btn-primary" href="/attendance?class_id=<?= (int) $class['id'] ?>">Presence</a>
        </header>

        <section class="form-card">
            <h2>Ajouter un etudiant</h2>
            <?php if (!empty($availableStudents)): ?>
                <form action="/classes/assign" method="POST" class="form-row">
                    <input type="hidden" name="class_id" value="<?= (int) $class['id'] ?>">
                    <div class="form-group">
                        <label for="student_id">Etudiant</label>
                        <select id="student_id" name="student_id" class="form-control" required>
                            <?php foreach ($availableStudents as $student): ?>
                                <option value="<?= (int) $student['id'] ?>">
                                    <?= htmlspecialchars($student['name']) ?> - <?= htmlspecialchars($student['email']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            <?php else: ?>
                <p>Tous les etudiants sont deja assignes a cette classe.</p>
            <?php endif; ?>
        </section>

        <section class="form-card">
            <h2>Etudiants de la classe</h2>
            <?php if (!empty($students)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= htmlspecialchars($student['name']) ?></td>
                                <td><?= htmlspecialchars($student['email']) ?></td>
                                <td>
                                    <form action="/classes/remove" method="POST">
                                        <input type="hidden" name="class_id" value="<?= (int) $class['id'] ?>">
                                        <input type="hidden" name="student_id" value="<?= (int) $student['id'] ?>">
                                        <button type="submit" class="btn btn-secondary">Retirer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun etudiant assigne pour le moment.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
