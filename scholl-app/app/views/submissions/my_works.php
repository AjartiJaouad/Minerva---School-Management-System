<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Devoirs</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .works-container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }
        .works-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .works-header h1 {
            margin: 0;
            color: #333;
        }
        .works-header .btn {
            background: #95a5a6;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .works-grid {
            display: grid;
            gap: 20px;
        }
        .work-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #3498db;
        }
        .work-title {
            margin: 0 0 10px 0;
            color: #333;
            font-size: 18px;
        }
        .work-description {
            color: #666;
            margin: 0 0 15px 0;
            line-height: 1.5;
        }
        .work-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .work-meta-info {
            color: #999;
        }
        .submission-status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .status-submitted {
            background: #d4edda;
            color: #155724;
        }
        .work-actions {
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
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .empty-state p {
            color: #999;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="works-container">
        <div class="works-header">
            <h1>📚 Mes Devoirs</h1>
            <a href="/student/dashboard" class="btn btn-secondary">← Dashboard</a>
        </div>

        <!-- Notifications -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                ✓ <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                ✗ <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Works List -->
        <?php if (count($works) > 0): ?>
            <div class="works-grid">
                <?php foreach ($works as $work): ?>
                    <div class="work-card">
                        <h3 class="work-title"><?= htmlspecialchars($work['title']) ?></h3>
                        <p class="work-description"><?= htmlspecialchars($work['description']) ?></p>
                        
                        <div class="work-meta">
                            <div class="work-meta-info">
                                📅 <?= date('d/m/Y', strtotime($work['created_at'])) ?>
                            </div>
                            <span class="submission-status <?= $work['submission_id'] ? 'status-submitted' : 'status-pending' ?>">
                                <?= $work['submission_id'] ? '✓ Soumis' : '○ Non soumis' ?>
                            </span>
                        </div>

                        <?php if ($work['submission_id']): ?>
                            <div class="work-meta-info" style="font-size: 12px; margin-bottom: 15px;">
                                Soumis le: <?= date('d/m/Y à H:i', strtotime($work['submitted_at'])) ?>
                            </div>
                        <?php endif; ?>

                        <div class="work-actions">
                            <a href="/submissions/show?id=<?= $work['id'] ?>" class="btn btn-primary">
                                👁️ Voir et soumettre
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <p>📭 Aucun devoir pour le moment</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
