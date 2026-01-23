<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Etudiant - EduConnect</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<?php
$studentName = htmlspecialchars($name ?? 'Etudiant');
$studentEmail = htmlspecialchars($_SESSION['email'] ?? 'etudiant@edu.com');
?>
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>EduConnect</h2>
            <p class="user-role">Etudiant</p>
        </div>

        <nav class="sidebar-nav">
            <a href="/student/dashboard" class="nav-item active">
                <span class="nav-icon"><i class="fa-solid fa-chart-line"></i></span>
                <span class="nav-text">Tableau de bord</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-school"></i></span>
                <span class="nav-text">Ma Classe</span>
            </a>
            <a href="/student/works" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-book-open"></i></span>
                <span class="nav-text">Mes Travaux</span>
            </a>
            <a href="/student/grades" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-star"></i></span>
                <span class="nav-text">Mes Notes</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-user-check"></i></span>
                <span class="nav-text">Presence</span>
            </a>
            <a href="/chat" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-comments"></i></span>
                <span class="nav-text">Chat</span>
                <span class="badge">3</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-avatar"><i class="fa-solid fa-user-graduate"></i></div>
                <div class="user-info">
                    <p class="user-name"><?= $studentName ?></p>
                    <p class="user-email"><?= $studentEmail ?></p>
                </div>
            </div>
            <a href="/auth/logout" class="logout-btn">
                <span><i class="fa-solid fa-right-from-bracket"></i></span>
                <span>Deconnexion</span>
            </a>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div class="topbar-left">
                <h1>Tableau de bord</h1>
                <p class="welcome-text">Bienvenue, <?= $studentName ?></p>
            </div>
            <div class="topbar-right">
                <div class="search-box">
                    <input type="text" placeholder="Rechercher...">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
                <button class="notification-btn">
                    <i class="fa-solid fa-bell"></i>
                    <span class="notification-badge">2</span>
                </button>
            </div>
        </header>

        <section class="stats-section">
            <div class="stats-grid">
                <div class="stat-card stat-card-1">
                    <div class="stat-icon"><i class="fa-solid fa-book-open"></i></div>
                    <div class="stat-info">
                        <h3>Travaux</h3>
                        <p class="stat-number"><?= (int) $workCount ?></p>
                        <p class="stat-change neutral"><?= (int) $pendingWorkCount ?> a rendre</p>
                    </div>
                </div>

                <div class="stat-card stat-card-2">
                    <div class="stat-icon"><i class="fa-solid fa-star"></i></div>
                    <div class="stat-info">
                        <h3>Moyenne</h3>
                        <p class="stat-number"><?= $averageGrade !== null ? $averageGrade : '-' ?></p>
                        <p class="stat-change positive">+0.8 ce mois</p>
                    </div>
                </div>

                <div class="stat-card stat-card-3">
                    <div class="stat-icon"><i class="fa-solid fa-user-check"></i></div>
                    <div class="stat-info">
                        <h3>Presence</h3>
                        <p class="stat-number">96%</p>
                        <p class="stat-change positive">Assiduite</p>
                    </div>
                </div>

                <div class="stat-card stat-card-4">
                    <div class="stat-icon"><i class="fa-solid fa-school"></i></div>
                    <div class="stat-info">
                        <h3>Ma classe</h3>
                        <p class="stat-number">2nde B</p>
                        <p class="stat-change neutral">Avec M. Dupont</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="quick-actions">
            <h2 class="section-title">
                <span class="title-icon"><i class="fa-solid fa-bolt"></i></span>
                Actions rapides
            </h2>
            <div class="actions-grid">
                <button class="action-btn action-primary" type="button" onclick="window.location.href=\"/student/works\"">
                    <span class="action-icon"><i class="fa-solid fa-upload"></i></span>
                    <span>Soumettre un travail</span>
                </button>
                <button class="action-btn action-secondary" type="button" onclick="window.location.href=\"/student/grades\""><span class="action-icon"><i class="fa-solid fa-star"></i></span><span>Voir mes notes</span></button>
                <button class="action-btn action-secondary">
                    <span class="action-icon"><i class="fa-solid fa-school"></i></span>
                    <span>Voir ma classe</span>
                </button>
                <button class="action-btn action-secondary">
                    <span class="action-icon"><i class="fa-solid fa-comments"></i></span>
                    <span>Ouvrir chat</span>
                </button>
            </div>
        </section>

        <div class="content-grid">
            <section class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span><i class="fa-solid fa-book"></i></span>
                        Mes travaux
                    </h2>
                    <a href="/student/works" class="card-link">Voir tout ?</a>
                </div>
                <div class="work-list">
                    <?php if (!empty($recentWorks)): ?>
                        <?php foreach ($recentWorks as $work): ?>
                            <?php $statusLabel = $work['status'] === 'submitted' ? 'Rendu' : 'A rendre'; ?>
                            <div class="work-item">
                                <div class="work-priority priority-medium"><i class="fa-solid fa-circle"></i></div>
                                <div class="work-details">
                                    <h3><?= htmlspecialchars($work['title']) ?></h3>
                                    <p class="work-meta">
                                        <span><i class="fa-solid fa-school"></i> <?= htmlspecialchars($work['class_name']) ?></span>
                                        <span><i class="fa-solid fa-hourglass"></i> <?= $statusLabel ?></span>
                                    </p>
                                </div>
                                <div class="work-status">
                                    <div class="work-actions">
                                        <?php if ($work['status'] === 'submitted'): ?>
                                            <a class="status-badge status-complete work-action" href="/student/works/submit?id=<?= (int) $work['id'] ?>">Voir</a>
                                        <?php else: ?>
                                            <a class="status-badge status-pending work-action" href="/student/works/submit?id=<?= (int) $work['id'] ?>">Soumettre</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="welcome-text">Aucun travail assigne.</p>
                    <?php endif; ?>
                </div>
            </section>

            <section class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span><i class="fa-solid fa-star"></i></span>
                        Mes notes
                    </h2>
                    <a href="/student/grades" class="card-link">Voir tout ?</a>
                </div>
                <div class="activity-list">
                    <?php if (!empty($recentGrades)): ?>
                        <?php foreach ($recentGrades as $grade): ?>
                            <div class="activity-item">
                                <div class="activity-icon activity-grade"><i class="fa-solid fa-star"></i></div>
                                <div class="activity-details">
                                    <p><strong><?= htmlspecialchars($grade['title']) ?></strong></p>
                                    <p class="activity-time"><?= $grade['grade'] !== null ? htmlspecialchars($grade['grade']) . '/20' : 'En attente' ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="welcome-text">Aucune note disponible.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>
</body>
</html>





