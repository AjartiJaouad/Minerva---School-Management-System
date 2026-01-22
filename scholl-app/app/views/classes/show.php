<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($classe['name']) ?> - Détails</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .class-container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }
        .class-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .class-header h1 {
            margin: 0;
            color: #333;
        }
        .class-header .class-meta {
            color: #666;
            font-size: 14px;
        }
        .btn-group {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            font-size: 14px;
        }
        .btn-primary {
            background: #3498db;
            color: white;
        }
        .btn-primary:hover {
            background: #2980b9;
        }
        .btn-danger {
            background: #e74c3c;
            color: white;
        }
        .btn-danger:hover {
            background: #c0392b;
        }
        .students-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .students-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .students-header h2 {
            margin: 0;
            color: #333;
        }
        .student-list {
            display: grid;
            gap: 15px;
        }
        .student-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #3498db;
            border-radius: 5px;
        }
        .student-info h3 {
            margin: 0;
            color: #333;
        }
        .student-info p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 14px;
        }
        .remove-form {
            display: inline;
        }
        .remove-form button {
            background: #e74c3c;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }
        .remove-form button:hover {
            background: #c0392b;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="class-container">
        <!-- Notifications -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Class Header -->
        <div class="class-header">
            <div>
                <h1><?= htmlspecialchars($classe['name']) ?></h1>
                <p class="class-meta">Enseignant: <?= htmlspecialchars($classe['teacher_name']) ?></p>
            </div>
            <div class="btn-group">
                <a href="/classes/assign-students?id=<?= $classe['id'] ?>" class="btn btn-primary">
                    + Ajouter des étudiants
                </a>
                <a href="/classes" class="btn" style="background: #95a5a6; color: white;">
                    ← Retour
                </a>
            </div>
        </div>

        <!-- Students Section -->
        <div class="students-section">
            <div class="students-header">
                <h2>Étudiants inscrits (<?= count($students) ?>)</h2>
            </div>

            <?php if (count($students) > 0): ?>
                <div class="student-list">
                    <?php foreach ($students as $student): ?>
                        <div class="student-item">
                            <div class="student-info">
                                <h3><?= htmlspecialchars($student['name']) ?></h3>
                                <p><?= htmlspecialchars($student['email']) ?></p>
                            </div>
                            <form method="POST" action="/classes/remove-student" class="remove-form" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?');">
                                <input type="hidden" name="class_id" value="<?= $classe['id'] ?>">
                                <input type="hidden" name="student_id" value="<?= $student['id'] ?>">
                                <button type="submit">Supprimer</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>Aucun étudiant dans cette classe pour le moment.</p>
                    <a href="/classes/assign-students?id=<?= $classe['id'] ?>" class="btn btn-primary" 
                       style="display: inline-block; margin-top: 10px;">
                        Ajouter des étudiants
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
