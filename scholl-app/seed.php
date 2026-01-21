<?php
// seed.php

require_once __DIR__ . '/app/Core/Database.php';
require_once __DIR__ . '/app/Models/User.php';

use App\Models\User;

try {
    $userModel = new User();
    
    echo "--- Bdaya d'idkhal l'données ---<br>\n";

    $userModel->create("Professeur Hamza", "prof@gmail.com", "123456", "teacher");
    echo " Professeur ajouté (Email: prof@gmail.com)<br>\n";

    $etudiants = [
        ["bilal zrik", "bilal@student.com"],
        ["jaouad ajarti", "jaouad@gmail.com"],
        ["hatim x", "hatim@student.com"]
    ];

    foreach ($etudiants as $etu) {
        $userModel->create($etu[0], $etu[1], "123456", "student");
        echo " Étudiant ajouté : " . $etu[0] . "<br>\n";
    }

    echo "<hr> Salina! Les utilisateurs sont dans la base de données.";

} catch (Exception $e) {
    echo " Erreur: " . $e->getMessage();
}