<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Authentification</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="leaf-decoration leaf-1"></div>
    <div class="leaf-decoration leaf-2"></div>
    <div class="leaf-decoration leaf-3"></div>

    <div class="container">
        <div class="auth-card">
            <div class="logo">
                <h1>EduConnect</h1>
                <p>Plateforme Éducative</p>
            </div>

            <!-- Error/Success Messages -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message">
                    <?php 
                        echo htmlspecialchars($_SESSION['error']); 
                        unset($_SESSION['error']); 
                    ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="success-message">
                    <?php 
                        echo htmlspecialchars($_SESSION['success']); 
                        unset($_SESSION['success']); 
                    ?>
                </div>
            <?php endif; ?>

            <div class="tab-container">
                <button class="tab-btn active" onclick="switchTab('login')">Connexion</button>
                <button class="tab-btn" onclick="switchTab('register')">Inscription</button>
            </div>

            <!-- Login Form -->
            <div id="login-form" class="form-content active">
                <form action="/auth/login" method="POST">
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <div class="input-wrapper">
                            <span class="input-icon">📧</span>
                            <input type="email" id="login-email" name="email" class="form-control" 
                                   placeholder="votre.email@exemple.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="login-password">Mot de passe</label>
                        <div class="input-wrapper">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="login-password" name="password" class="form-control" 
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="role-selector">
                        <div class="role-option">
                            <input type="radio" id="role-student" name="role" value="student" checked>
                            <label for="role-student" class="role-label">
                                <span class="role-icon">🎓</span>
                                <span>Étudiant</span>
                            </label>
                        </div>
                        <div class="role-option">
                            <input type="radio" id="role-teacher" name="role" value="teacher">
                            <label for="role-teacher" class="role-label">
                                <span class="role-icon">👨‍🏫</span>
                                <span>Enseignant</span>
                            </label>
                        </div>
                    </div>

                    <div class="remember-forgot">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            <span>Se souvenir</span>
                        </label>
                        <a href="#" class="forgot-link">Mot de passe oublié?</a>
                    </div>

                    <button type="submit" class="submit-btn">Se connecter</button>
                </form>
            </div>

            <!-- Register Form -->
            <div id="register-form" class="form-content">
                <form action="/auth/register" method="POST">
                    <div class="form-group">
                        <label for="register-name">Nom complet</label>
                        <div class="input-wrapper">
                            <span class="input-icon">👤</span>
                            <input type="text" id="register-name" name="name" class="form-control" 
                                   placeholder="Prénom Nom" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <div class="input-wrapper">
                            <span class="input-icon">📧</span>
                            <input type="email" id="register-email" name="email" class="form-control" 
                                   placeholder="votre.email@exemple.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="register-password">Mot de passe</label>
                        <div class="input-wrapper">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="register-password" name="password" class="form-control" 
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="register-confirm">Confirmer mot de passe</label>
                        <div class="input-wrapper">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="register-confirm" name="confirm_password" class="form-control" 
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="role-selector">
                        <div class="role-option">
                            <input type="radio" id="reg-role-student" name="role" value="student" checked>
                            <label for="reg-role-student" class="role-label">
                                <span class="role-icon">🎓</span>
                                <span>Étudiant</span>
                            </label>
                        </div>
                        <div class="role-option">
                            <input type="radio" id="reg-role-teacher" name="role" value="teacher">
                            <label for="reg-role-teacher" class="role-label">
                                <span class="role-icon">👨‍🏫</span>
                                <span>Enseignant</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">S'inscrire</button>
                </form>
            </div>

            <div class="divider">
                <span>ou</span>
            </div>

            <div class="back-home">
                <a href="/">← Retour à l'accueil</a>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        function switchTab(tab) {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const formContents = document.querySelectorAll('.form-content');
            
            tabButtons.forEach(btn => btn.classList.remove('active'));
            formContents.forEach(form => form.classList.remove('active'));
            
            if (tab === 'login') {
                tabButtons[0].classList.add('active');
                document.getElementById('login-form').classList.add('active');
            } else if (tab === 'register') {
                tabButtons[1].classList.add('active');
                document.getElementById('register-form').classList.add('active');
            }
        }

        // Password validation for registration
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.querySelector('#register-form form');
            
            if (registerForm) {
                registerForm.addEventListener('submit', function(e) {
                    const password = document.getElementById('register-password').value;
                    const confirmPassword = document.getElementById('register-confirm').value;
                    
                    if (password !== confirmPassword) {
                        e.preventDefault();
                        alert('Les mots de passe ne correspondent pas!');
                        return false;
                    }
                    
                    if (password.length < 6) {
                        e.preventDefault();
                        alert('Le mot de passe doit contenir au moins 6 caractères!');
                        return false;
                    }
                });
            }
        });
    </script>
</body>
</html>
