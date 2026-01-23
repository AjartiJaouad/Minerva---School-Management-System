<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travaux</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Travaux</h1>
            <a class="btn btn-primary" href="/works/create">Creer un travail</a>
                    <a class="btn btn-secondary" href="/teacher/dashboard">Dashboard</a>
        </header>

        <div class="form-card">
            <?php if (!empty($works)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Classe</th>
                            <th>Assignes</th>
                            <th>Rendus</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($works as $work): ?>
                            <tr>
                                <td><?= htmlspecialchars($work['title']) ?></td>
                                <td><?= htmlspecialchars($work['class_name']) ?></td>
                                <td><?= (int) $work['assigned_count'] ?></td>
                                <td><?= (int) $work['submitted_count'] ?></td>
                                <td>
                                    <div class="table-actions">
                                        <a class="btn btn-secondary" href="/works/assign?id=<?= (int) $work['id'] ?>">Assigner</a>
                                        <a class="btn btn-primary" href="/grades/work?id=<?= (int) $work['id'] ?>">Noter</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun travail cree pour le moment.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
