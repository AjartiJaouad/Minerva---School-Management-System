<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Authentification</title>
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #2d5f5d 0%, #4a8e8b 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow-x: hidden;
    overflow-y: auto;
    padding: 40px 0;
}</style>
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

            <div class="tab-container">
                <button class="tab-btn active" onclick="switchTab('login')">Connexion</button>
                <button class="tab-btn" onclick="switchTab('register')">Inscription</button>
            </div>

            <!-- Login Form -->
            <div id="login-form" class="form-content active">
                <!-- Error/Success Messages -->
                <!-- <div class="error-message">Identifiants incorrects</div> -->
                <!-- <div class="success-message">Connexion réussie!</div> -->

                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <div class="input-wrapper">
                            <span class="input-icon">📧</span>
                            <input type="email" id="login-email" name="email" class="form-control" placeholder="votre.email@exemple.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="login-password">Mot de passe</label>
                        <div class="input-wrapper">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="login-password" name="password" class="form-control" placeholder="••••••••" required>
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
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <label for="register-name">Nom complet</label>
                        <div class="input-wrapper">
                            <span class="input-icon">👤</span>
                            <input type="text" id="register-name" name="name" class="form-control" placeholder="Prénom Nom" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <div class="input-wrapper">
                            <span class="input-icon">📧</span>
                            <input type="email" id="register-email" name="email" class="form-control" placeholder="votre.email@exemple.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="register-password">Mot de passe</label>
                        <div class="input-wrapper">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="register-password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="register-confirm">Confirmer mot de passe</label>
                        <div class="input-wrapper">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="register-confirm" name="confirm_password" class="form-control" placeholder="••••••••" required>
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
                <a href="index.html">← Retour à l'accueil</a>
            </div>
        </div>
    </div>

  <script src="../../../public/assets/js/script.js"></script>

</body>
</html>