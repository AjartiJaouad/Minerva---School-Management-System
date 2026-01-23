<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant - EduConnect</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<?php
$teacherName = htmlspecialchars($name ?? 'Enseignant');
$teacherEmail = htmlspecialchars($_SESSION['email'] ?? 'enseignant@edu.com');
?>
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>EduConnect</h2>
            <p class="user-role">Enseignant</p>
        </div>

        <nav class="sidebar-nav">
            <a href="/teacher/dashboard" class="nav-item active">
                <span class="nav-icon"><i class="fa-solid fa-chart-line"></i></span>
                <span class="nav-text">Tableau de bord</span>
            </a>
            <a href="/classes" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-school"></i></span>
                <span class="nav-text">Mes Classes</span>
            </a>
            <a href="/works" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-book-open"></i></span>
                <span class="nav-text">Devoirs</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-users"></i></span>
                <span class="nav-text">Etudiants</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-user-check"></i></span>
                <span class="nav-text">Presence</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-chart-pie"></i></span>
                <span class="nav-text">Statistiques</span>
            </a>
            <a href="/chat" class="nav-item">
                <span class="nav-icon"><i class="fa-solid fa-comments"></i></span>
                <span class="nav-text">Chat</span>
                <span class="badge">3</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-avatar"><i class="fa-solid fa-chalkboard-user"></i></div>
                <div class="user-info">
                    <p class="user-name"><?= $teacherName ?></p>
                    <p class="user-email"><?= $teacherEmail ?></p>
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
                <p class="welcome-text">Bienvenue, <?= $teacherName ?></p>
            </div>
            <div class="topbar-right">
                <div class="search-box">
                    <input type="text" placeholder="Rechercher...">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
                <button class="notification-btn">
                    <i class="fa-solid fa-bell"></i>
                    <span class="notification-badge">5</span>
                </button>
            </div>
        </header>

        <section class="stats-section">
            <div class="stats-grid">
                <div class="stat-card stat-card-1">
                    <div class="stat-icon"><i class="fa-solid fa-school"></i></div>
                    <div class="stat-info">
                        <h3>Classes</h3>
                        <p class="stat-number">4</p>
                        <p class="stat-change positive">+1 ce mois</p>
                    </div>
                </div>

                <div class="stat-card stat-card-2">
                    <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                    <div class="stat-info">
                        <h3>Etudiants</h3>
                        <p class="stat-number">128</p>
                        <p class="stat-change positive">+12 actifs</p>
                    </div>
                </div>

                <div class="stat-card stat-card-3">
                    <div class="stat-icon"><i class="fa-solid fa-book-open"></i></div>
                    <div class="stat-info">
                        <h3>Devoirs en cours</h3>
                        <p class="stat-number"><?= (int) $workCount ?></p>
                        <p class="stat-change neutral"><?= (int) $pendingCount ?> a corriger</p>
                    </div>
                </div>

                <div class="stat-card stat-card-4">
                    <div class="stat-icon"><i class="fa-solid fa-user-check"></i></div>
                    <div class="stat-info">
                        <h3>Taux de presence</h3>
                        <p class="stat-number">94%</p>
                        <p class="stat-change positive">+2% vs mois dernier</p>
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
                <button type="button" class="action-btn action-primary" onclick="window.location.href='/works/create'">
                    <span class="action-icon"><i class="fa-solid fa-pen-to-square"></i></span>
                    <span>Creer un devoir</span>
                </button>
                <button type="button" class="action-btn action-secondary" onclick="window.location.href='/students/create'">
                    <span class="action-icon"><i class="fa-solid fa-user-plus"></i></span>
                    <span>Ajouter un etudiant</span>
                </button>
                <button type="button" class="action-btn action-secondary" onclick="window.location.href='/classes'">
                    <span class="action-icon"><i class="fa-solid fa-user-check"></i></span>
                    <span>Prendre presence</span>
                </button>
                <button class="action-btn action-secondary" type="button">
                    <span class="action-icon"><i class="fa-solid fa-chart-column"></i></span>
                    <span>Voir statistiques</span>
                </button>
            </div>
        </section>

        <div class="content-grid">
            <section class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span><i class="fa-solid fa-book"></i></span>
                        Devoirs recents
                    </h2>
                    <a href="/works" class="card-link">Voir tout ?</a>
                </div>
                <div class="work-list">
                    <?php if (!empty($recentWorks)): ?>
                        <?php foreach ($recentWorks as $work): ?>
                            <div class="work-item">
                                <div class="work-priority priority-medium"><i class="fa-solid fa-circle"></i></div>
                                <div class="work-details">
                                    <h3><?= htmlspecialchars($work['title']) ?></h3>
                                    <p class="work-meta">
                                        <span><i class="fa-solid fa-users"></i> <?= htmlspecialchars($work['class_name']) ?></span>
                                        <span><i class="fa-solid fa-check"></i> <?= (int) $work['submitted_count'] ?>/<?= (int) $work['assigned_count'] ?> rendus</span>
                                    </p>
                                </div>
                                <div class="work-status">
                                    <div class="work-actions">
                                        <a class="status-badge status-pending work-action" href="/works/assign?id=<?= (int) $work['id'] ?>">Assigner</a>
                                        <a class="status-badge status-complete work-action" href="/grades/work?id=<?= (int) $work['id'] ?>">Noter</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="welcome-text">Aucun devoir pour le moment.</p>
                    <?php endif; ?>
                </div>
            </section>

            <section class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span><i class="fa-solid fa-file-pen"></i></span>
                        A corriger
                    </h2>
                    <a href="/works" class="card-link">Voir tout ?</a>
                </div>
                <div class="work-list">
                    <?php if (!empty($pendingWorks)): ?>
                        <?php foreach ($pendingWorks as $work): ?>
                            <div class="work-item">
                                <div class="work-priority priority-high"><i class="fa-solid fa-circle"></i></div>
                                <div class="work-details">
                                    <h3><?= htmlspecialchars($work['title']) ?></h3>
                                    <p class="work-meta">
                                        <span><i class="fa-solid fa-users"></i> <?= htmlspecialchars($work['class_name']) ?></span>
                                        <span><i class="fa-solid fa-check"></i> <?= (int) $work['submitted_count'] ?> soumis</span>
                                    </p>
                                </div>
                                <div class="work-status">
                                    <div class="work-actions">
                                        <a class="status-badge status-complete work-action" href="/grades/work?id=<?= (int) $work['id'] ?>">Noter</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="welcome-text">Aucune soumission a corriger.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>
</body>
</html>






