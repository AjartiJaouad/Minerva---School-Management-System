<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Plateforme Éducative</title>
 
        <link rel="stylesheet" href="/assets/css/style.css">
   
    
</head>
<body>
    <section class="hero">
        <div class="hero-content">
            <h1>EduConnect<br>Platform</h1>
            <p>Une plateforme éducative moderne pour connecter enseignants et étudiants. Gérez vos classes, travaux, évaluations et communications en un seul endroit.</p>
            <a href="/auth/login" class="cta-button">Commencer</a>
        </div>
        <div class="hero-visual">
            <div class="leaf leaf1"></div>
            <div class="leaf leaf2"></div>
            <div class="leaf leaf3"></div>
        </div>
    </section>

    <section class="features">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Authentification</h3>
                <p>Connexion sécurisée avec gestion des rôles enseignant et étudiant pour un accès personnalisé</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🏫</div>
                <h3>Gestion Classes</h3>
                <p>Créez et organisez vos classes facilement avec assignation automatique des étudiants</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <h3>Travaux</h3>
                <p>Distribuez et collectez les devoirs avec suivi en temps réel des soumissions</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⏰</div>
                <h3>Présence</h3>
                <p>Suivez l'assiduité de vos étudiants avec des statistiques détaillées et alertes</p>
            </div>
        </div>

        <div class="modules">
            <div class="module-card">
                <div class="module-icon">📝</div>
                <h3>Créer Étudiants</h3>
                <p>Génération automatique de comptes avec mot de passe sécurisé et envoi par email</p>
            </div>
            <div class="module-card">
                <div class="module-icon">🌿</div>
                <h3>Évaluations</h3>
                <p>Notez les travaux avec commentaires détaillés visibles instantanément par les étudiants</p>
            </div>
            <div class="module-card">
                <div class="module-icon">🍂</div>
                <h3>Statistiques</h3>
                <p>Visualisez la progression avec graphiques et tableaux de bord interactifs</p>
            </div>
            <div class="module-card">
                <div class="module-icon">🌾</div>
                <h3>Voir Classe</h3>
                <p>Les étudiants découvrent leurs camarades et enseignants en un coup d'œil</p>
            </div>
            <div class="module-card">
                <div class="module-icon">🌸</div>
                <h3>Mes Notes</h3>
                <p>Consultez vos notes et feedbacks pour suivre votre progression académique</p>
            </div>
            <div class="module-card">
                <div class="module-icon">💬</div>
                <h3>Chat Groupe</h3>
                <p>Communiquez en temps réel avec votre classe pour questions et partages</p>
            </div>
        </div>
    </section>

    <div class="footer">
        <p>© 2026 EduConnect - Plateforme Éducative MVC</p>
    </div>

    <!-- <script>
        // Parallax effect on sc../../../public/assets/css/style.css../../../public/assets/css/style.cssroll
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const leaves = document.querySelectorAll('.leaf');
            leaves.forEach((leaf, index) => {
                const speed = 0.5 + (index * 0.2);
                leaf.style.transform += ` translateY(${scrolled * speed}px)`;
            });
        });

        // Card hover effect
        const cards = document.querySelectorAll('.feature-card, .module-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function(e) {
                this.style.transition = 'all 0.3s ease';
            });
        });
    </script> -->
</body>
</html>
