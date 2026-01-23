<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Classes</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2d5f5d 0%, #4a8e8b 100%);
            color: #fff;
            min-height: 100vh;
            padding: 40px 6vw 60px;
        }

        .page {
            max-width: 1100px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .page-header h2 {
            font-size: 2rem;
            font-weight: 300;
            color: #f5e6d3;
            margin: 0 0 6px;
        }

        .page-header p {
            margin: 0;
            color: rgba(255, 255, 255, 0.7);
        }

        .btn {
            padding: 12px 22px;
            border-radius: 18px;
            border: none;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-add {
            background: linear-gradient(135deg, #d4a574 0%, #c89960 100%);
            box-shadow: 0 10px 25px rgba(212, 165, 116, 0.3);
        }

        .btn-del {
            background: rgba(231, 76, 60, 0.25);
            border: 1px solid rgba(231, 76, 60, 0.45);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .table-card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            padding: 20px;
            backdrop-filter: blur(10px);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 14px 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            color: rgba(255, 255, 255, 0.6);
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.8);
        }

        @media (max-width: 700px) {
            .page-header {
                align-items: flex-start;
            }

            th,
            td {
                padding: 12px 8px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <header class="page-header">
            <div>
                <h2>Gestion des Classes</h2>
                <p>Organisez vos classes et enseignants en un seul endroit.</p>
            </div>
            <a href="/classes/create" class="btn btn-add">+ Nouvelle Classe</a>
                    <a class="btn btn-secondary" href="/teacher/dashboard">Dashboard</a>
        </header>

        <section class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom de la classe</th>
                        <th>Enseignant</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($classes as $classe): ?>
                        <tr>
                            <td><?= $classe['id'] ?></td>
                            <td><?= htmlspecialchars($classe['name']) ?></td>
                            <td>
                                <?php if (!empty($classe['teacher_name'])): ?>
                                    <?= htmlspecialchars($classe['teacher_name']) ?>
                                <?php else: ?>
                                    <span class="badge">Non assigne</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/classes/delete?id=<?= $classe['id'] ?>" class="btn btn-del" onclick="return confirm('Supprimer cette classe ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
