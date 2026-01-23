<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($work['title']) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .submission-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
        }
        .work-details {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .work-details h1 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .work-details .description {
            color: #666;
            line-height: 1.6;
            margin: 15px 0;
        }
        .work-details .meta {
            display: flex;
            gap: 20px;
            font-size: 14px;
            color: #999;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .submission-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .submission-form h2 {
            margin: 0 0 20px 0;
            color: #333;
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
        textarea, input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        textarea:focus, input[type="file"]:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        textarea {
            resize: vertical;
            min-height: 200px;
        }
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
        }
        .file-info {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }
        .form-divider {
            text-align: center;
            color: #999;
            margin: 20px 0;
            position: relative;
        }
        .form-divider::before {
            content: '─────────────────────';
            display: block;
            margin-bottom: 10px;
        }
        .button-group {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
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
        .submission-info {
            background: #f0f4f8;
            padding: 15px;
            border-left: 4px solid #3498db;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .submission-info strong {
            color: #333;
        }
        .submission-info p {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="submission-container">
        <!-- Work Details -->
        <div class="work-details">
            <h1><?= htmlspecialchars($work['title']) ?></h1>
            <p class="description"><?= htmlspecialchars($work['description']) ?></p>
            <div class="meta">
                <div>📅 Publié le: <?= date('d/m/Y à H:i', strtotime($work['created_at'])) ?></div>
            </div>
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

        <!-- Existing Submission -->
        <?php if ($submission): ?>
            <div class="submission-info">
                <strong>✓ Soumission existante</strong>
                <p>Soumis le: <?= date('d/m/Y à H:i', strtotime($submission['submitted_at'])) ?></p>
                <?php if ($submission['content']): ?>
                    <p>Contenu: <?= htmlspecialchars(substr($submission['content'], 0, 50)) ?>...</p>
                <?php endif; ?>
                <?php if ($submission['file_path']): ?>
                    <p>Fichier: <a href="<?= htmlspecialchars($submission['file_path']) ?>" download style="color: #3498db;">Télécharger</a></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Submission Form -->
        <div class="submission-form">
            <h2>📤 Soumettre votre travail</h2>
            <form method="POST" action="/submissions/submit" enctype="multipart/form-data" onsubmit="return validateForm()">
                <input type="hidden" name="work_id" value="<?= $work['id'] ?>">

                <!-- Text Content -->
                <div class="form-group">
                    <label for="content">Contenu du devoir:</label>
                    <textarea id="content" name="content" placeholder="Écrivez votre réponse ici..."><?= isset($submission['content']) ? htmlspecialchars($submission['content']) : '' ?></textarea>
                </div>

                <div class="form-divider">OU</div>

                <!-- File Upload -->
                <div class="form-group">
                    <label for="file">Télécharger un fichier:</label>
                    <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png,.zip">
                    <div class="file-info">
                        Format acceptés: PDF, DOC, DOCX, TXT, JPG, PNG, ZIP (Max 10MB)
                    </div>
                </div>

                <div class="button-group">
                    <a href="/submissions/my-works" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">
                        <?= $submission ? '📝 Mettre à jour' : '✓ Soumettre' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            const content = document.getElementById('content').value.trim();
            const file = document.getElementById('file').files.length;

            if (content === '' && file === 0) {
                alert('Veuillez soumettre du texte ou un fichier!');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
