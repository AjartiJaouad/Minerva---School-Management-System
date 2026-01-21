<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - EduConnect</title>
    
    <link rel="stylesheet" href="/assets/css/style.css"> 
    
    <style>
        body {
            font-family: sans-serif;
            background: linear-gradient(135deg, #2d5f5d 0%, #4a8e8b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }
        .auth-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box; 
        }
        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #2d5f5d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-btn:hover {
            background: #1f4241;
        }
        .logo h1 { color: #2d5f5d; margin-bottom: 5px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="auth-card">
            <div class="logo">
                <h1>EduConnect</h1>
                <p>Bienvenue</p>
            </div>

            <form action="/login" method="POST">
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="exemple@gmail.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="submit-btn">Se connecter</button>
            </form>

            <div style="margin-top: 15px; font-size: 14px;">
                <p>Pas encore de compte ? <a href="/register" style="color: #2d5f5d;">S'inscrire</a></p>
            </div>
        </div>
    </div>

</body>
</html>