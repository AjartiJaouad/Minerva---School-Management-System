<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Devoir - EduConnect</title>
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <div class="breadcrumb">
                <a href="dashboard.php">Tableau de bord</a>
                <span>→</span>
                <a href="works.php">Devoirs</a>
                <span>→</span>
                <span>Créer un devoir</span>
            </div>
            <h1>📚 Créer un Devoir</h1>
            <p>Créez et assignez un nouveau travail à vos étudiants</p>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <form action="create_work.php" method="POST" enctype="multipart/form-data">

                <!-- Section: Informations de base -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="section-icon">📝</span> Informations de base
                    </h2>

                    <div class="form-group">
                        <label for="title">Titre du devoir <span class="required">*</span></label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Ex: Dissertation sur la Révolution Française" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description <span class="required">*</span></label>
                        <textarea id="description" name="description" class="form-control" rows="6" placeholder="Décrivez les objectifs et consignes du devoir..." required></textarea>
                        <small class="help-text">💡 Soyez clair et précis dans vos consignes</small>
                    </div>
                </div>

                <!-- Section: Planification -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="section-icon">📅</span> Planification
                    </h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="start_date">Date de début <span class="required">*</span></label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="due_date">Date limite <span class="required">*</span></label>
                            <input type="date" id="due_date" name="due_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="class">Classe <span class="required">*</span></label>
                            <select id="class" name="class_id" class="form-control" required>
                                <option value="">-- Sélectionner une classe --</option>
                                <option value="1">3ème A - Mathématiques</option>
                                <option value="2">2nde B - Français</option>
                                <option value="3">1ère C - Histoire</option>
                                <option value="4">Terminale D - Philosophie</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="points">Points (sur 100)</label>
                            <input type="number" id="points" name="points" class="form-control" min="0" max="100" placeholder="20">
                        </div>
                    </div>
                </div>

                <!-- Section: Pièces jointes -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="section-icon">📎</span> Pièces jointes (optionnel)
                    </h2>

                    <div class="form-group">
                        <label for="attachments">Ajouter des fichiers</label>
                        <div class="file-upload-wrapper">
                            <input type="file" id="attachments" name="attachments[]" class="file-upload-input" multiple accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.png">
                            <label for="attachments" class="file-upload-label">
                                <span>📁</span>
                                <span>Cliquez pour ajouter des fichiers</span>
                            </label>
                        </div>
                        <small class="help-text">
                            📄 Formats acceptés: PDF, DOC, DOCX, PPT, PPTX, JPG, PNG (Max 10 MB)
                        </small>
                        <div id="file-list" class="file-list"></div>
                    </div>
                </div>

                <!-- Section: Options avancées -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="section-icon">⚙️</span> Options avancées
                    </h2>

                    <div class="form-group">
                        <label>Priorité</label>
                        <div class="priority-options">
                            <div class="priority-option">
                                <input type="radio" id="priority-low" name="priority" value="low" checked>
                                <label for="priority-low" class="priority-label">
                                    <span class="priority-icon">🟢</span>
                                    <span>Faible</span>
                                </label>
                            </div>
                            <div class="priority-option">
                                <input type="radio" id="priority-medium" name="priority" value="medium">
                                <label for="priority-medium" class="priority-label">
                                    <span class="priority-icon">🟡</span>
                                    <span>Moyenne</span>
                                </label>
                            </div>
                            <div class="priority-option">
                                <input type="radio" id="priority-high" name="priority" value="high">
                                <label for="priority-high" class="priority-label">
                                    <span class="priority-icon">🔴</span>
                                    <span>Haute</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="allow_late" value="1">
                            <span>Autoriser les soumissions en retard</span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="notify_students" value="1" checked>
                            <span>Notifier les étudiants par email</span>
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                        ← Annuler
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        🔄 Réinitialiser
                    </button>
                    <button type="submit" class="btn btn-primary">
                        ✓ Créer le devoir
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // File upload preview
        const fileInput = document.getElementById('attachments');
        const fileLabel = document.querySelector('.file-upload-label');
        const fileList = document.getElementById('file-list');

        fileInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);

            if (files.length > 0) {
                fileLabel.classList.add('has-file');
                fileLabel.innerHTML = `<span>📁</span><span>${files.length} fichier(s) sélectionné(s)</span>`;

                // Display file list
                fileList.innerHTML = files.map(file => `
                    <div class="file-item">
                        <span>📄 ${file.name}</span>
                        <span>${(file.size / 1024).toFixed(2)} KB</span>
                    </div>
                `).join('');
            } else {
                fileLabel.classList.remove('has-file');
                fileLabel.innerHTML = '<span>📁</span><span>Cliquez pour ajouter des fichiers</span>';
                fileList.innerHTML = '';
            }
        });

        // Date validation
        const startDate = document.getElementById('start_date');
        const dueDate = document.getElementById('due_date');

        startDate.addEventListener('change', function() {
            dueDate.min = this.value;
        });

        dueDate.addEventListener('change', function() {
            if (startDate.value && this.value < startDate.value) {
                alert('La date limite doit être après la date de début');
                this.value = '';
            }
        });

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        startDate.min = today;
        dueDate.min = today;
    </script>
</body>

</html>