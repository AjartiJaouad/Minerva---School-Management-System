<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - <?= htmlspecialchars($class['name'] ?? '') ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main class="container">
        <header class="page-header">
            <h1>Chat - <?= htmlspecialchars($class['name'] ?? '') ?></h1>
            <a class="btn btn-secondary" href="/chat">Retour</a>
        </header>

        <div class="form-card">
            <?php if (!empty($messages)): ?>
                <div class="activity-list">
                    <?php foreach ($messages as $message): ?>
                        <div class="activity-item">
                            <div class="activity-details">
                                <p><strong><?= htmlspecialchars($message['name']) ?>:</strong> <?= htmlspecialchars($message['message']) ?></p>
                                <p class="activity-time"><?= htmlspecialchars($message['created_at']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Aucun message pour le moment.</p>
            <?php endif; ?>
        </div>

        <form class="form-card" action="/chat/send" method="POST">
            <input type="hidden" name="class_id" value="<?= (int) ($class['id'] ?? 0) ?>">
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </main>
</body>
</html>
