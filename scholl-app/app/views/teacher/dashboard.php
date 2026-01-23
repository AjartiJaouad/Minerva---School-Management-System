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
            <a href="#" class="nav-item">
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
            <a href="#" class="nav-item">
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
                        <p class="stat-number">8</p>
                        <p class="stat-change neutral">3 a corriger</p>
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
                    <a href="#" class="card-link">Voir tout ?</a>
                </div>
                <div class="work-list">
                    <div class="work-item">
                        <div class="work-priority priority-high"><i class="fa-solid fa-circle"></i></div>
                        <div class="work-details">
                            <h3>Dissertation Histoire</h3>
                            <p class="work-meta">
                                <span><i class="fa-solid fa-calendar"></i> Echeance: 25 Jan 2026</span>
                                <span><i class="fa-solid fa-users"></i> 3eme A</span>
                            </p>
                        </div>
                        <div class="work-status">
                            <span class="status-badge status-pending">15/30 rendus</span>
                        </div>
                    </div>

                    <div class="work-item">
                        <div class="work-priority priority-medium"><i class="fa-solid fa-circle"></i></div>
                        <div class="work-details">
                            <h3>Exercices Mathematiques</h3>
                            <p class="work-meta">
                                <span><i class="fa-solid fa-calendar"></i> Echeance: 28 Jan 2026</span>
                                <span><i class="fa-solid fa-users"></i> 2nde B</span>
                            </p>
                        </div>
                        <div class="work-status">
                            <span class="status-badge status-complete">25/25 rendus</span>
                        </div>
                    </div>

                    <div class="work-item">
                        <div class="work-priority priority-low"><i class="fa-solid fa-circle"></i></div>
                        <div class="work-details">
                            <h3>Lecture Chapitre 5</h3>
                            <p class="work-meta">
                                <span><i class="fa-solid fa-calendar"></i> Echeance: 30 Jan 2026</span>
                                <span><i class="fa-solid fa-users"></i> 1ere C</span>
                            </p>
                        </div>
                        <div class="work-status">
                            <span class="status-badge status-pending">8/20 rendus</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span><i class="fa-solid fa-school"></i></span>
                        Mes classes
                    </h2>
                    <a href="/classes" class="card-link">Gerer ?</a>
                </div>
                <div class="class-list">
                    <div class="class-item">
                        <div class="class-icon class-icon-1">3A</div>
                        <div class="class-info">
                            <h3>3eme A - Mathematiques</h3>
                            <p>30 etudiants � Lundi, Mercredi</p>
                        </div>
                        <button class="class-action-btn">?</button>
                    </div>

                    <div class="class-item">
                        <div class="class-icon class-icon-2">2B</div>
                        <div class="class-info">
                            <h3>2nde B - Francais</h3>
                            <p>25 etudiants � Mardi, Jeudi</p>
                        </div>
                        <button class="class-action-btn">?</button>
                    </div>

                    <div class="class-item">
                        <div class="class-icon class-icon-3">1C</div>
                        <div class="class-info">
                            <h3>1ere C - Histoire</h3>
                            <p>28 etudiants � Vendredi</p>
                        </div>
                        <button class="class-action-btn">?</button>
                    </div>

                    <div class="class-item">
                        <div class="class-icon class-icon-4">TD</div>
                        <div class="class-info">
                            <h3>Terminale D - Philosophie</h3>
                            <p>20 etudiants � Mercredi</p>
                        </div>
                        <button class="class-action-btn">?</button>
                    </div>
                </div>
            </section>
        </div>

        <div class="content-grid">
            <section class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span><i class="fa-solid fa-calendar-days"></i></span>
                        Calendrier
                    </h2>
                </div>
                <div class="calendar">
                    <div class="calendar-header">
                        <button class="calendar-nav"><i class="fa-solid fa-chevron-left"></i></button>
                        <h3>Janvier 2026</h3>
                        <button class="calendar-nav"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                    <div class="calendar-grid">
                        <div class="calendar-day disabled">29</div>
                        <div class="calendar-day disabled">30</div>
                        <div class="calendar-day disabled">31</div>
                        <div class="calendar-day">1</div>
                        <div class="calendar-day">2</div>
                        <div class="calendar-day">3</div>
                        <div class="calendar-day">4</div>
                        <div class="calendar-day">5</div>
                        <div class="calendar-day">6</div>
                        <div class="calendar-day">7</div>
                        <div class="calendar-day">8</div>
                        <div class="calendar-day">9</div>
                        <div class="calendar-day">10</div>
                        <div class="calendar-day">11</div>
                        <div class="calendar-day">12</div>
                        <div class="calendar-day">13</div>
                        <div class="calendar-day">14</div>
                        <div class="calendar-day">15</div>
                        <div class="calendar-day">16</div>
                        <div class="calendar-day">17</div>
                        <div class="calendar-day">18</div>
                        <div class="calendar-day">19</div>
                        <div class="calendar-day today">20</div>
                        <div class="calendar-day has-event">21</div>
                        <div class="calendar-day">22</div>
                        <div class="calendar-day">23</div>
                        <div class="calendar-day has-event">24</div>
                        <div class="calendar-day has-event">25</div>
                        <div class="calendar-day">26</div>
                        <div class="calendar-day">27</div>
                        <div class="calendar-day">28</div>
                        <div class="calendar-day">29</div>
                        <div class="calendar-day">30</div>
                        <div class="calendar-day">31</div>
                    </div>
                    <div class="calendar-events">
                        <div class="event-item">
                            <span class="event-dot event-high"></span>
                            <span>25 Jan - Devoir Histoire</span>
                        </div>
                        <div class="event-item">
                            <span class="event-dot event-medium"></span>
                            <span>28 Jan - Examen Maths</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span><i class="fa-solid fa-list-check"></i></span>
                        Activite recente
                    </h2>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon activity-submit"><i class="fa-solid fa-file-arrow-up"></i></div>
                        <div class="activity-details">
                            <p><strong>Marie Dubois</strong> a rendu son devoir</p>
                            <p class="activity-time">Il y a 5 minutes</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon activity-grade"><i class="fa-solid fa-star"></i></div>
                        <div class="activity-details">
                            <p>Vous avez note <strong>15 devoirs</strong></p>
                            <p class="activity-time">Il y a 1 heure</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon activity-class"><i class="fa-solid fa-user-plus"></i></div>
                        <div class="activity-details">
                            <p><strong>3 nouveaux etudiants</strong> ajoutes en 2nde B</p>
                            <p class="activity-time">Il y a 2 heures</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon activity-chat"><i class="fa-solid fa-comment-dots"></i></div>
                        <div class="activity-details">
                            <p><strong>Jean Martin</strong> a envoye un message</p>
                            <p class="activity-time">Il y a 3 heures</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon activity-submit"><i class="fa-solid fa-file-arrow-up"></i></div>
                        <div class="activity-details">
                            <p><strong>12 etudiants</strong> ont rendu leur devoir</p>
                            <p class="activity-time">Hier a 18:30</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>




