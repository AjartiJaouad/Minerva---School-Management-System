<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des étudiants - <?= htmlspecialchars($classe['name']) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .assign-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }
        .assign-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .assign-header {
            margin-bottom: 30px;
        }
        .assign-header h1 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .assign-header p {
            margin: 0;
            color: #666;
        }
        .form-group {
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }
        select, input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }
        select:focus, input[type="text"]:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        .students-grid {
            display: grid;
            gap: 15px;
            margin-top: 20px;
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #eee;
            padding: 15px;
            border-radius: 5px;
        }
        .student-checkbox {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 5px;
        }
        .student-checkbox input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 15px;
            cursor: pointer;
        }
        .student-checkbox label {
            margin: 0;
            font-weight: normal;
            cursor: pointer;
            flex: 1;
        }
        .student-checkbox .email {
            color: #666;
            font-size: 13px;
            margin-top: 3px;
        }
        .button-group {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 30px;
        }
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: #3498db;
            color: white;
        }
        .btn-primary:hover {
            background: #2980b9;
        }
        .btn-secondary {
            background: #95a5a6;
            color: white;
        }
        .btn-secondary:hover {
            background: #7f8c8d;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .no-students {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="assign-container">
        <div class="assign-card">
            <div class="assign-header">
                <h1>Ajouter des étudiants</h1>
                <p>Classe: <strong><?= htmlspecialchars($classe['name']) ?></strong></p>
            </div>

            <?php if (count($unassignedStudents) > 0): ?>
                <div class="alert alert-info">
                    ℹ️ Sélectionnez les étudiants à ajouter à cette classe
                </div>

                <form method="POST" action="/classes/add-student">
                    <input type="hidden" name="class_id" value="<?= $classe['id'] ?>">
                    
                    <div class="form-group">
                        <label for="student_select">Sélectionner les étudiants:</label>
                        <div class="students-grid">
                            <?php foreach ($unassignedStudents as $student): ?>
                                <div class="student-checkbox">
                                    <input type="checkbox" id="student_<?= $student['id'] ?>" 
                                           name="student_ids[]" value="<?= $student['id'] ?>">
                                    <label for="student_<?= $student['id'] ?>">
                                        <?= htmlspecialchars($student['nom']) ?>
                                        <div class="email"><?= htmlspecialchars($student['email']) ?></div>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="button-group">
                        <a href="/classes/show?id=<?= $classe['id'] ?>" class="btn btn-secondary">
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Ajouter les étudiants sélectionnés
                        </button>
                    </div>
                </form>

                <script>
                    document.querySelector('form').addEventListener('submit', function(e) {
                        const checkedBoxes = document.querySelectorAll('input[name="student_ids[]"]:checked');
                        if (checkedBoxes.length === 0) {
                            e.preventDefault();
                            alert('Veuillez sélectionner au moins un étudiant');
                        }
                    });
                </script>
            <?php else: ?>
                <div class="no-students">
                    <p>✓ Tous les étudiants sont déjà affectés à cette classe!</p>
                    <a href="/classes/show?id=<?= $classe['id'] ?>" class="btn btn-primary" 
                       style="margin-top: 15px;">
                        Retour à la classe
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
