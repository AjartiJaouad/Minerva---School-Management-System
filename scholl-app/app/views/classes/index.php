<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Classes</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .btn {
            padding: 8px 15px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
        }

        .btn-add {
            background-color: #28a745;
        }

        .btn-del {
            background-color: #dc3545;
        }
    </style>
</head>

<body>

    <h2>Gestion des Classes</h2>
    <a href="/classes/create" class="btn btn-add">+ Nouvelle Classe</a>

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
                        <?= !empty($classe['teacher_name']) ? htmlspecialchars($classe['teacher_name']) : '<span style="color:gray">Non assigné</span>' ?>
                    </td>
                    <td>
                        <a href="/classes/show?id=<?= $classe['id'] ?>" class="btn btn-details" style="background-color: #007bff; text-decoration: none; color: white; padding: 8px 15px; border-radius: 4px; margin-right: 5px;">Détails</a>
                        <a href="/classes/delete?id=<?= $classe['id'] ?>" class="btn btn-del" onclick="return confirm('Supprimer cette classe ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>