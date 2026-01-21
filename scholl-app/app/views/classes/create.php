<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Classe</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        form { max-width: 400px; margin-top: 20px; }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Ajouter une nouvelle classe</h2>
    
    <form action="/classes/create" method="POST">
        <div>
            <label>Nom de la classe :</label>
            <input type="text" name="name" required placeholder="Ex: 1ère Année Bac">
        </div>

        <div>
            <label>ID de l'enseignant :</label>
            <input type="number" name="teacher_id" required placeholder="ID du prof">
        </div>

        <button type="submit">Enregistrer</button>
        <a href="/classes" style="margin-left: 10px;">Annuler</a>
    </form>

</body>
</html>