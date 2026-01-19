
---

## 📌 User Stories

### 🔐 US-01 – Authentification
**En tant qu’utilisateur (enseignant ou étudiant)**, je veux me connecter afin d’accéder à l’application selon mon rôle.

**Critères d’acceptation :**
- Vérification des identifiants
- Redirection selon le rôle
- Message d’erreur en cas d’échec

---

### 🏫 US-02 – Créer une classe
**En tant qu’enseignant**, je veux créer une classe afin de gérer mes étudiants.

**Critères d’acceptation :**
- Formulaire de création de classe
- Classe visible dans l’espace enseignant
- Assignation d’étudiants à la classe

---

### 👤 US-03 – Créer un étudiant
**En tant qu’enseignant**, je veux créer un compte étudiant afin qu’il puisse accéder à la plateforme.

**Critères d’acceptation :**
- Mot de passe généré aléatoirement
- Email envoyé à l’étudiant avec ses identifiants
- Mot de passe stocké de manière sécurisée (hash)

---

### 📄 US-04 – Créer un travail
**En tant qu’enseignant**, je veux créer un travail (document, leçon, exercice).

**Critères d’acceptation :**
- Formulaire de création
- Travail stocké en base de données
- Possibilité de joindre des fichiers

---

### 📌 US-05 – Assigner un travail
**En tant qu’enseignant**, je veux assigner un travail à un ou plusieurs étudiants.

**Critères d’acceptation :**
- Sélection multiple d’étudiants
- Travail visible pour les étudiants concernés

---

### 📝 US-06 – Évaluer un travail
**En tant qu’enseignant**, je veux évaluer les travaux des étudiants.

**Critères d’acceptation :**
- Saisie de la note et d’un commentaire
- Note visible pour l’étudiant

---

### 📊 US-07 – Prendre l’absentéisme
**En tant qu’enseignant**, je veux gérer la présence des étudiants.

**Critères d’acceptation :**
- Sélection présents / absents
- Statistiques visibles

---

### 📈 US-08 – Voir les statistiques
**En tant qu’enseignant**, je veux consulter des statistiques.

**Critères d’acceptation :**
- Statistiques sur notes, présence et travaux rendus
- Tableau ou graphiques synthétiques

---

### 📥 US-09 – Répondre à un travail
**En tant qu’étudiant**, je veux répondre aux travaux assignés.

**Critères d’acceptation :**
- Liste des travaux assignés
- Soumission texte ou fichier
- Confirmation de soumission

---

### 👥 US-10 – Voir sa classe
**En tant qu’étudiant**, je veux voir ma classe.

**Critères d’acceptation :**
- Liste des étudiants
- Informations de l’enseignant (nom, email)

---

### 🧮 US-11 – Voir mes notes
**En tant qu’étudiant**, je veux voir mes notes.

**Critères d’acceptation :**
- Notes visibles par travail
- Commentaires affichés

---

### 💬 US-12 – Chat en groupe
**En tant qu’étudiant**, je veux discuter avec ma classe et mon enseignant.

**Critères d’acceptation :**
- Chat accessible enseignants / étudiants
- Messages en temps réel
- Historique limité ou paginé

---

## 🧩 Design Pattern
### Singleton – Database
- Une seule instance de connexion à la base de données
- Accès global et sécurisé
- Classe `Database` centralisée dans `Core/`

---

## 📐 UML (Obligatoire)

### Diagramme de cas d’utilisation
- Acteurs : **Étudiant**, **Enseignant**
- Connexion, classes, travaux, notes, présence, chat

### Diagramme de classes
Entités principales :
- User
- Student
- Teacher
- Class
- Work
- Submission
- Attendance
- Grade
- ChatMessage

Relations, attributs et méthodes documentés.

---

## 🗓️ Planning sur 5 jours

### Jour 1 – Préparation & Architecture
- Structure MVC
- Singleton Database
- Tables principales
- README & dépôt GitHub

### Jour 2 – Authentification & rôles
- Comptes étudiants / enseignants
- Connexion / déconnexion
- Tests d’accès par rôle

### Jour 3 – Classes & Travaux
- Création des classes
- Assignation des étudiants
- Création et assignation des travaux

### Jour 4 – Interaction & Évaluations
- Soumission des travaux
- Évaluation et notation
- Gestion de la présence

### Jour 5 – Chat & Finalisation
- Chat de classe
- Statistiques enseignant
- Tests finaux & bonus (Twig, AJAX, .htaccess)

---

## 🔄 Bonnes pratiques Git / GitHub
- Dépôt créé dès le premier jour
- Chaque membre clone le projet
- Travail sur **branches séparées**
- Commits fréquents et clairs
- Pull Request avant merge
- ❌ Ne jamais travailler directement sur `main`
- Résoudre les conflits en équipe et tester avant merge

---

## 👥 Auteurs
Projet réalisé en binôme dans un cadre pédagogique.

---

## ✅ Statut du projet
🟡 En cours
