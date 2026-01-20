<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Plateforme Éducative</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2d5f5d 0%, #4a8e8b 100%);
            color: #fff;
            overflow-x: hidden;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 80px 10%;
            position: relative;
            background: 
                radial-gradient(ellipse at top right, rgba(139, 186, 159, 0.3) 0%, transparent 50%),
                radial-gradient(ellipse at bottom left, rgba(205, 168, 130, 0.2) 0%, transparent 50%),
                linear-gradient(135deg, #2d5f5d 0%, #4a8e8b 100%);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 500px;
            height: 500px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="%238bba9f" opacity="0.3" d="M100,20 Q150,50 150,100 T100,180 Q50,150 50,100 T100,20 Z"/></svg>');
            background-size: contain;
            opacity: 0.4;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .hero-content {
            max-width: 600px;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 4.5rem;
            font-weight: 300;
            letter-spacing: 2px;
            margin-bottom: 30px;
            line-height: 1.1;
            color: #f5e6d3;
        }

        .hero-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 40px;
            color: rgba(255, 255, 255, 0.9);
            max-width: 500px;
        }

        .cta-button {
            display: inline-block;
            padding: 18px 50px;
            background: linear-gradient(135deg, #d4a574 0%, #c89960 100%);
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 500;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .hero-visual {
            position: relative;
            width: 400px;
            height: 400px;
            z-index: 2;
        }

        .leaf {
            position: absolute;
            border-radius: 80% 0 80% 0;
            opacity: 0.8;
            animation: leafFloat 8s ease-in-out infinite;
        }

        .leaf1 {
            width: 180px;
            height: 250px;
            background: linear-gradient(135deg, #8bba9f 0%, #6a9c87 100%);
            top: 0;
            right: 50px;
            transform: rotate(15deg);
            box-shadow: inset 0 0 40px rgba(0,0,0,0.2);
        }

        .leaf2 {
            width: 200px;
            height: 280px;
            background: linear-gradient(135deg, #d4a574 0%, #b8916a 100%);
            bottom: 30px;
            left: 0;
            transform: rotate(-25deg);
            animation-delay: -2s;
            box-shadow: inset 0 0 40px rgba(0,0,0,0.2);
        }

        .leaf3 {
            width: 150px;
            height: 220px;
            background: linear-gradient(135deg, #6a9c87 0%, #5a8574 100%);
            top: 80px;
            left: 100px;
            transform: rotate(45deg);
            animation-delay: -4s;
            box-shadow: inset 0 0 40px rgba(0,0,0,0.2);
        }

        @keyframes leafFloat {
            0%, 100% { transform: translateY(0) rotate(var(--rotation, 0deg)); }
            50% { transform: translateY(-15px) rotate(calc(var(--rotation, 0deg) + 5deg)); }
        }

        .features {
            background: linear-gradient(180deg, #4a8e8b 0%, #5a9e9b 100%);
            padding: 80px 10%;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .feature-card h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .feature-card p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.8);
        }

        .modules {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .module-card {
            background: linear-gradient(135deg, rgba(139, 186, 159, 0.3) 0%, rgba(106, 156, 135, 0.3) 100%);
            backdrop-filter: blur(10px);
            padding: 50px 40px;
            border-radius: 30px;
            text-align: center;
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .module-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .module-card:hover::before {
            opacity: 1;
        }

        .module-card:nth-child(2) {
            background: linear-gradient(135deg, rgba(180, 116, 90, 0.3) 0%, rgba(150, 95, 75, 0.3) 100%);
        }

        .module-card:nth-child(3) {
            background: linear-gradient(135deg, rgba(212, 165, 116, 0.3) 0%, rgba(184, 145, 106, 0.3) 100%);
        }

        .module-card:nth-child(4) {
            background: linear-gradient(135deg, rgba(106, 156, 135, 0.3) 0%, rgba(90, 133, 116, 0.3) 100%);
        }

        .module-card:nth-child(5) {
            background: linear-gradient(135deg, rgba(150, 95, 75, 0.3) 0%, rgba(130, 80, 65, 0.3) 100%);
        }

        .module-card:nth-child(6) {
            background: linear-gradient(135deg, rgba(184, 145, 106, 0.3) 0%, rgba(165, 130, 95, 0.3) 100%);
        }

        .module-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
        }

        .module-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .module-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .module-card p {
            font-size: 1rem;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.85);
        }

        .footer {
            text-align: center;
            padding: 40px;
            background: rgba(0, 0, 0, 0.2);
            margin-top: 80px;
        }

        @media (max-width: 1200px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .modules {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
                padding: 60px 5%;
            }
            
            .hero-content h1 {
                font-size: 3rem;
            }
            
            .hero-visual {
                margin-top: 50px;
                width: 300px;
                height: 300px;
            }
            
            .features-grid,
            .modules {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="hero-content">
            <h1>EduConnect<br>Platform</h1>
            <p>Une plateforme éducative moderne pour connecter enseignants et étudiants. Gérez vos classes, travaux, évaluations et communications en un seul endroit.</p>
            <a href="#" class="cta-button">Commencer</a>
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

    <script>
        // Parallax effect on scroll
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
    </script>
</body>
</html>