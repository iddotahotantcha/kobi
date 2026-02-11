@extends('layouts.app')

@section('title', 'Ajouter un Enseignant')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="bi bi-mortarboard-fill"></i> KOBI School
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                       data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> Directeur (Admin)
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right"></i> Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 px-0 sidebar">
            <div class="py-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('students.index') }}">
                            <i class="bi bi-people"></i> Élèves
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('teachers.index') }}">
                            <i class="bi bi-person-badge"></i> Enseignants
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classes.index') }}">
                            <i class="bi bi-building"></i> Classes
                        </a>
                    </li>
                    <li class="nav-item">
    <a class="nav-link" href="{{ route('matieres.index') }}">
        <i class="bi bi-book"></i> Matières
    </a>
</li>
                    <li class="nav-item">
    <a class="nav-link" href="{{ route('reports.index') }}">
        <i class="bi bi-file-earmark-text"></i> Rapports
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('settings.index') }}">
        <i class="bi bi-gear"></i> Paramètres
    </a>
</li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 px-md-4">
            <div class="py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-0"><i class="bi bi-person-plus-fill"></i> Ajouter un Enseignant</h2>
                        <p class="text-muted">Remplissez le formulaire pour enregistrer un nouvel enseignant</p>
                    </div>
                    <div>
                        <a href="/teachers" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Retour à la liste
                        </a>
                    </div>
                </div>
                <!-- Messages d'erreur -->
@if ($errors->any())
    <div class="alert alert-danger">
        <h5><i class="bi bi-exclamation-triangle"></i> Erreurs détectées :</h5>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <!-- Formulaire -->
<form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
    @csrf                    
                    <div class="row">
                        <!-- Colonne gauche -->
                        <div class="col-md-8">
                            <!-- Informations personnelles -->
                            <div class="card mb-4">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0"><i class="bi bi-person"></i> Informations Personnelles</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="nom" name="nom" 
       value="{{ old('nom') }}" placeholder="Ex: Dupont" required>                                        </div>

                                        <div class="col-md-6">
                                            <label for="prenom" class="form-label">Prénom(s) <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="prenom" name="prenom" 
       value="{{ old('prenom') }}" placeholder="Ex: Pierre Jean" required>
                                            </div>

                                        <div class="col-md-6">
                                            <label for="date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
<input type="date" class="form-control" id="date_naissance" name="date_naissance" 
       value="{{ old('date_naissance') }}" required>
                                            </div>

                                        <div class="col-md-6">
                                            <label for="lieu_naissance" class="form-label">Lieu de naissance <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" 
       value="{{ old('lieu_naissance') }}" placeholder="Ex: Cotonou" required>
                                            </div>

                                        <div class="col-md-6">
                                            <label for="genre" class="form-label">Genre <span class="text-danger">*</span></label>
<select class="form-select" id="genre" name="genre" required>
    <option value="">-- Sélectionner --</option>
    <option value="M" {{ old('genre') == 'M' ? 'selected' : '' }}>Masculin</option>
    <option value="F" {{ old('genre') == 'F' ? 'selected' : '' }}>Féminin</option>
</select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="nationalite" class="form-label">Nationalité <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="nationalite" name="nationalite" 
       value="{{ old('nationalite') }}" placeholder="Ex: Béninoise" required>
                                            </div>

                                        <div class="col-md-6">
                                            <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
<input type="tel" class="form-control" id="telephone" name="telephone" 
       value="{{ old('telephone') }}" placeholder="Ex: +229 97 12 34 56" required>
                                            </div>

                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
<input type="email" class="form-control" id="email" name="email" 
       value="{{ old('email') }}" placeholder="Ex: enseignant@kobi.school" required>
                                            </div>

                                        <div class="col-12">
                                            <label for="adresse" class="form-label">Adresse complète <span class="text-danger">*</span></label>
<textarea class="form-control" id="adresse" name="adresse" rows="2" 
          placeholder="Ex: Quartier Akpakpa, Rue 123" required>{{ old('adresse') }}</textarea>                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations professionnelles -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="bi bi-briefcase"></i> Informations Professionnelles</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="matricule" class="form-label">Matricule <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="matricule" name="matricule" 
                                                   placeholder="Auto-généré" required readonly>
                                            <small class="text-muted">Format: ENS-YYYY-XXX</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="diplome" class="form-label">Diplôme <span class="text-danger">*</span></label>
<select class="form-select" id="diplome" name="diplome" required>
    <option value="">-- Sélectionner --</option>
    <option value="Licence" {{ old('diplome') == 'Licence' ? 'selected' : '' }}>Licence</option>
    <option value="Master" {{ old('diplome') == 'Master' ? 'selected' : '' }}>Master</option>
    <option value="Doctorat" {{ old('diplome') == 'Doctorat' ? 'selected' : '' }}>Doctorat</option>
    <option value="CAP" {{ old('diplome') == 'CAP' ? 'selected' : '' }}>CAP Enseignement</option>
    <option value="Autre" {{ old('diplome') == 'Autre' ? 'selected' : '' }}>Autre</option>
</select>
                                        </div>

                                        <div class="col-md-6">
    <label for="matiere_id" class="form-label">Matière enseignée <span class="text-danger">*</span></label>
    <select class="form-select @error('matiere_id') is-invalid @enderror" 
            id="matiere_id" name="matiere_id" required>
        <option value="">-- Sélectionner une matière --</option>
        @foreach($matieres as $matiere)
            <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>
                {{ $matiere->nom }} ({{ $matiere->code }})
            </option>
        @endforeach
    </select>
    @error('matiere_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted">Matière principale enseignée</small>
</div>

                                        <div class="col-md-6">
                                            <label for="annees_experience" class="form-label">Années d'expérience</label>
<input type="number" class="form-control" id="annees_experience" name="annees_experience" 
       value="{{ old('annees_experience') }}" placeholder="Ex: 5" min="0">
                                            </div>

                                        <div class="col-md-6">
                                            <label for="date_embauche" class="form-label">Date d'embauche <span class="text-danger">*</span></label>
<input type="date" class="form-control" id="date_embauche" name="date_embauche" 
       value="{{ old('date_embauche') }}" required>
                                            </div>

                                        <div class="col-md-6">
                                            <label for="statut" class="form-label">Statut <span class="text-danger">*</span></label>
<select class="form-select" id="statut" name="statut" required>
    <option value="actif" {{ old('statut', 'actif') == 'actif' ? 'selected' : '' }}>Actif</option>
    <option value="inactif" {{ old('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
    <option value="conge" {{ old('statut') == 'conge' ? 'selected' : '' }}>En congé</option>
</select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Assignment et Accès -->
                            <div class="card mb-4">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="bi bi-key"></i> Assignation et Accès</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        
                                        <div class="col-md-6">
    <label for="classe_id" class="form-label">Classe assignée</label>
    <select class="form-select" id="classe_id" name="classe_id">
        <option value="">-- Aucune classe --</option>
        @foreach($classes as $classe)
            <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                {{ $classe->nom }}
            </option>
        @endforeach
    </select>
    <small class="text-muted">Laisser vide si pas encore assigné</small>
</div>

                                        <div class="col-md-6">
                                            <label for="role" class="form-label">Rôle <span class="text-danger">*</span></label>
<select class="form-select" id="role" name="role" required>
    <option value="editeur" {{ old('role', 'editeur') == 'editeur' ? 'selected' : '' }}>Éditeur (Enseignant)</option>
    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
</select>
                                            <small class="text-muted">Éditeur = accès limité à sa classe uniquement</small>
                                        </div>

                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                <i class="bi bi-info-circle"></i> 
                                                <strong>Important :</strong> Les identifiants de connexion (email et mot de passe temporaire) 
                                                seront automatiquement générés et envoyés par email à l'enseignant après l'enregistrement.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="username" class="form-label">Nom d'utilisateur <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="username" name="username" 
       value="{{ old('username') }}" placeholder="Ex: p.dupont" required>                                            <small class="text-muted">Pour la connexion</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="password_temp" class="form-label">Mot de passe temporaire <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="password_temp" name="password_temp" 
                                                       placeholder="Généré automatiquement" required readonly>
                                                <button class="btn btn-outline-secondary" type="button" onclick="generatePassword()">
                                                    <i class="bi bi-arrow-clockwise"></i>
                                                </button>
                                            </div>
                                            <small class="text-muted">L'enseignant pourra le changer lors de la 1ère connexion</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Colonne droite -->
                        <div class="col-md-4">
                            <!-- Photo de l'enseignant -->
                            <div class="card mb-4">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0"><i class="bi bi-camera"></i> Photo de l'enseignant</h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <img id="photo-preview" src="https://via.placeholder.com/200x200?text=Photo+Enseignant" 
                                             alt="Photo enseignant" class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                    </div>
<input type="file" class="form-control" id="photo" name="photo" 
       accept="image/*" onchange="previewPhoto(event)" required>                                    <small class="text-muted">Format: JPG, PNG (Max 2MB)</small>
                                </div>
                            </div>

                            <!-- Documents -->
                            <div class="card mb-4">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> Documents</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="cv" class="form-label">CV (PDF)</label>
                                        <input type="file" class="form-control" id="cv" name="cv" accept=".pdf">
                                    </div>

                                    <div class="mb-3">
                                        <label for="diplome_file" class="form-label">Copie du diplôme</label>
                                        <input type="file" class="form-control" id="diplome_file" name="diplome_file" accept=".pdf,.jpg,.png">
                                    </div>

                                    <div class="mb-0">
                                        <label for="autres_docs" class="form-label">Autres documents</label>
                                        <input type="file" class="form-control" id="autres_docs" name="autres_docs" accept=".pdf,.jpg,.png" multiple>
                                        <small class="text-muted">Vous pouvez sélectionner plusieurs fichiers</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="bi bi-save"></i> Enregistrer et Envoyer Email
                                        </button>
                                        <button type="button" class="btn btn-outline-primary" onclick="previewEmail()">
                                            <i class="bi bi-envelope"></i> Prévisualiser l'email
                                        </button>
                                        <a href="/teachers" class="btn btn-outline-secondary">
                                            <i class="bi bi-x-circle"></i> Annuler
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de prévisualisation de l'email -->
<div class="modal fade" id="emailPreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-envelope"></i> Prévisualisation de l'email</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="email-preview p-4 border rounded">
                    <h4>Bienvenue à KOBI School !</h4>
                    <p>Bonjour <strong id="preview-nom"></strong>,</p>
                    <p>Nous sommes heureux de vous accueillir au sein de notre équipe pédagogique.</p>
                    <p>Voici vos identifiants de connexion à la plateforme de gestion :</p>
                    <div class="alert alert-info">
                        <p><strong>Nom d'utilisateur :</strong> <span id="preview-username"></span></p>
                        <p><strong>Mot de passe temporaire :</strong> <span id="preview-password"></span></p>
                        <p><strong>Lien de connexion :</strong> <a href="#">http://kobi.school/login</a></p>
                    </div>
                    <p><strong>⚠️ Important :</strong> Pour des raisons de sécurité, veuillez changer votre mot de passe lors de votre première connexion.</p>
                    <p>Cordialement,<br>L'administration KOBI School</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Prévisualisation de la photo
    function previewPhoto(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('photo-preview');
            preview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Auto-générer le matricule
    window.addEventListener('DOMContentLoaded', function() {
        const year = new Date().getFullYear();
        const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
        document.getElementById('matricule').value = `ENS-${year}-${random}`;
        
        // Générer un mot de passe temporaire
        generatePassword();
    });

    // Générer un mot de passe aléatoire
    function generatePassword() {
        const length = 10;
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%";
        let password = "";
        for (let i = 0; i < length; i++) {
            password += charset.charAt(Math.floor(Math.random() * charset.length));
        }
        document.getElementById('password_temp').value = password;
    }

    // Auto-générer le nom d'utilisateur à partir du nom et prénom
    document.getElementById('nom').addEventListener('input', updateUsername);
    document.getElementById('prenom').addEventListener('input', updateUsername);

    function updateUsername() {
        const nom = document.getElementById('nom').value.toLowerCase().trim();
        const prenom = document.getElementById('prenom').value.toLowerCase().trim().split(' ')[0];
        if (prenom && nom) {
            document.getElementById('username').value = `${prenom.charAt(0)}.${nom}`;
        }
    }

    // Prévisualiser l'email
    function previewEmail() {
        const nom = document.getElementById('nom').value;
        const prenom = document.getElementById('prenom').value;
        const username = document.getElementById('username').value;
        const password = document.getElementById('password_temp').value;

        document.getElementById('preview-nom').textContent = `${prenom} ${nom}`;
        document.getElementById('preview-username').textContent = username;
        document.getElementById('preview-password').textContent = password;

        const modal = new bootstrap.Modal(document.getElementById('emailPreviewModal'));
        modal.show();
    }
</script>
@endsection
@endsection