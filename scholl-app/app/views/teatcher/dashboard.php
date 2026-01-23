<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EduConnect</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>🍃 EduConnect</h2>
            <p class="user-role">Enseignant</p>
        </div>

        <nav class="sidebar-nav">
            <a href="#" class="nav-item active">
                <span class="nav-icon">📊</span>
                <span class="nav-text">Tableau de bord</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">🏫</span>
                <span class="nav-text">Mes Classes</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">📚</span>
                <span class="nav-text">Devoirs</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">👥</span>
                <span class="nav-text">Étudiants</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">✅</span>
                <span class="nav-text">Présence</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">📈</span>
                <span class="nav-text">Statistiques</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">💬</span>
                <span class="nav-text">Chat</span>
                <span class="badge">3</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-avatar">👨‍🏫</div>
                <div class="user-info">
                    <p class="user-name"><?= htmlspecialchars($_SESSION['nom'] ?? 'Professeur') ?></p>
                    <p class="user-email">enseignant@edu.com</p>
                </div>
            </div>
            <a href="/logout" class="logout-btn">
                <span>🚪</span>
                <span>Déconnexion</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <header class="topbar">
            <div class="topbar-left">
                <h1>Tableau de bord</h1>
                <p class="welcome-text">Bienvenue, <?= htmlspecialchars($_SESSION['nom'] ?? 'Professeur') ?> 👋</p>
            </div>
            <div class="topbar-right">
                <div class="search-box">
                    <input type="text" placeholder="Rechercher...">
                    <span class="search-icon">🔍</span>
                </div>
                <button class="notification-btn">
                    🔔
                    <span class="notification-badge">5</span>
                </button>
            </div>
        </header>

        <!-- Stats Cards -->
        <section class="stats-section">
            <div class="stats-grid">
                <div class="stat-card stat-card-1">
                    <div class="stat-icon">🏫</div>
                    <div class="stat-info">
                        <h3>Classes</h3>
                        <p class="stat-number">4</p>
                        <p class="stat-change positive">+1 ce mois</p>
                    </div>
                </div>

                <div class="stat-card stat-card-2">
                    <div class="stat-icon">👥</div>
                    <div class="stat-info">
                        <h3>Étudiants</h3>
                        <p class="stat-number">128</p>
                        <p class="stat-change positive">+12 actifs</p>
                    </div>
                </div>

                <div class="stat-card stat-card-3">
                    <div class="stat-icon">📚</div>
                    <div class="stat-info">
                        <h3>Devoirs en cours</h3>
                        <p class="stat-number">8</p>
                        <p class="stat-change neutral">3 à corriger</p>
                    </div>
                </div>

                <div class="stat-card stat-card-4">
                    <div class="stat-icon">✅</div>
                    <div class="stat-info">
                        <h3>Taux de présence</h3>
                        <p class="stat-number">94%</p>
                        <p class="stat-change positive">+2% vs mois dernier</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Actions -->
        <section class="quick-actions">
            <h2 class="section-title">
                <span class="title-icon">⚡</span>
                Actions rapides
            </h2>
            <div class="actions-grid">
                <button class="action-btn action-primary">
                    <span class="action-icon">📝</span>
                    <span>Créer un devoir</span>
                </button>
                <button class="action-btn action-secondary">
                    <span class="action-icon">👤</span>
                    <span>Ajouter un étudiant</span>
                </button>
                <button class="action-btn action-secondary">
                    <span class="action-icon">✅</span>
                    <span>Prendre présence</span>
                </button>
                <button class="action-btn action-secondary">
                    <span class="action-icon">📊</span>
                    <span>Voir statistiques</span>
                </button>
            </div>
        </section>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Recent Works -->
            <section class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span>📚</span>
                        Devoirs récents
                    </h2>
                    <a href="#" class="card-link">Voir tout →</a>
                </div>
                <div class="work-list">
                    <div class="work-item">
                        <div class="work-priority priority-high">🔴</div>
                        <div class="work-details">
                            <h3>Dissertation Histoire</h3>
                            <p class="work-meta">
                                <span>📅 Échéance: 25 Jan 2026</span>
                                <span>👥 3ème A</span>
                            </p>
                        </div>
                        <div class="work-status">
                            <span class="status-badge status-pending">15/30 rendus</span>
                        </div>
                    </div>

                    <div class="work-item">
                        <div class="work-priority priority-medium">🟡</div>
                        <div class="work-details">
                            <h3>Exercices Mathématiques</h3>
                            <p class="work-meta">
                                <span>📅 Échéance: 28 Jan 2026</span>
                                <span>👥 2nde B</span>
                            </p>
                        </div>
                        <div class="work-status">
                            <span class="status-badge status-complete">25/25 rendus</span>
                        </div>
                    </div>

                    <div class="work-item">
                        <div class="work-priority priority-low">🟢</div>
                        <div class="work-details">
                            <h3>Lecture Chapitre 5</h3>
                            <p class="work-meta">
                                <span>📅 Échéance: 30 Jan 2026</span>
                                <span>👥 1ère C</span>
                            </p>
                        </div>
                        <div class="work-status">
                            <span class="status-badge status-pending">8/20 rendus</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Recent Classes -->
            <section class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span>🏫</span>
                        Mes classes
                    </h2>
                    <a href="#" class="card-link">Gérer →</a>
                </div>
                <div class="class-list">
                    <div class="class-item">
                        <div class="class-icon class-icon-1">3A</div>
                        <div class="class-info">
                            <h3>3ème A - Mathématiques</h3>
                            <p>30 étudiants • Lundi, Mercredi</p>
                        </div>
                        <button class="class-action-btn">→</button>
                    </div>

                    <div class="class-item">
                        <div class="class-icon class-icon-2">2B</div>
                        <div class="class-info">
                            <h3>2nde B - Français</h3>
                            <p>25 étudiants • Mardi, Jeudi</p>
                        </div>
                        <button class="class-action-btn">→</button>
                    </div>

                    <div class="class-item">
                        <div class="class-icon class-icon-3">1C</div>
                        <div class="class-info">
                            <h3>1ère C - Histoire</h3>
                            <p>28 étudiants • Vendredi</p>
                        </div>
                        <button class="class-action-btn">→</button>
                    </div>

                    <div class="class-item">
                        <div class="class-icon class-icon-4">TD</div>
                        <div class="class-info">
                            <h3>Terminale D - Philosophie</h3>
                            <p>20 étudiants • Mercredi</p>
                        </div>
                        <button class="class-action-btn">→</button>
                    </div>
                </div>
            </section>
        </div>

        <!-- Calendar & Activity -->
        <div class="content-grid">
            <!-- Calendar -->
            <section class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span>📅</span>
                        Calendrier
                    </h2>
                </div>
                <div class="calendar">
                    <div class="calendar-header">
                        <button class="calendar-nav">←</button>
                        <h3>Janvier 2026</h3>
                        <button class="calendar-nav">→</button>
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

            <!-- Recent Activity -->
            <section class="content-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span>📋</span>
                        Activité récente
                    </h2>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon activity-submit">📝</div>
                        <div class="activity-details">
                            <p><strong>Marie Dubois</strong> a rendu son devoir</p>
                            <p class="activity-time">Il y a 5 minutes</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon activity-grade">⭐</div>
                        <div class="activity-details">
                            <p>Vous avez noté <strong>15 devoirs</strong></p>
                            <p class="activity-time">Il y a 1 heure</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon activity-class">👥</div>
                        <div class="activity-details">
                            <p><strong>3 nouveaux étudiants</strong> ajoutés en 2nde B</p>
                            <p class="activity-time">Il y a 2 heures</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon activity-chat">💬</div>
                        <div class="activity-details">
                            <p><strong>Jean Martin</strong> a envoyé un message</p>
                            <p class="activity-time">Il y a 3 heures</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon activity-submit">📝</div>
                        <div class="activity-details">
                            <p><strong>12 étudiants</strong> ont rendu leur devoir</p>
                            <p class="activity-time">Hier à 18:30</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        // Sidebar navigation active state
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Search functionality
        const searchBox = document.querySelector('.search-box input');
        searchBox.addEventListener('focus', function() {
            this.parentElement.style.boxShadow = '0 0 20px rgba(212, 165, 116, 0.3)';
        });
        searchBox.addEventListener('blur', function() {
            this.parentElement.style.boxShadow = 'none';
        });
    </script>
</body>
</html>