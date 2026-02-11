@extends('layouts.app')

@section('title', 'Ajouter un Élève')

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
                        <i class="bi bi-person-circle"></i> Admin
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
                        <a class="nav-link active" href="/students">
                            <i class="bi bi-people"></i> Élèves
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person-badge"></i> Enseignants
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
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
                        <h2 class="mb-0"><i class="bi bi-person-plus"></i> Ajouter un Élève</h2>
                        <p class="text-muted">Remplissez le formulaire pour enregistrer un nouvel élève</p>
                    </div>
                    <div>
                        <a href="/students" class="btn btn-outline-secondary">
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
                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Colonne gauche -->
                        <div class="col-md-8">
                            <!-- Informations personnelles -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="bi bi-person"></i> Informations Personnelles</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nom" name="nom" 
                                                   placeholder="Ex: Kouassi" value="{{ old('nom') }}"required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="prenom" class="form-label">Prénom(s) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="prenom" name="prenom" 
                                                   placeholder="Ex: Jean Marie" value="{{ old('prenom') }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="lieu_naissance" class="form-label">Lieu de naissance <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" 
                                                   placeholder="Ex: Cotonou" value="{{ old('lieu_naissance') }}" required>
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
                                                   placeholder="Ex: Béninoise" value="{{ old('nationalite') }}" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="adresse" class="form-label">Adresse complète <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="adresse" name="adresse" rows="2" 
                                                      placeholder="Ex: Quartier Akpakpa, Rue 123" required>{{ old('adresse') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations scolaires -->
                            <div class="card mb-4">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0"><i class="bi bi-book"></i> Informations Scolaires</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="matricule" class="form-label">Matricule <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="matricule" name="matricule" 
                                                   placeholder="Auto-généré ou saisir" value="{{ old('matricule') }}" required>
                                            <small class="text-muted">Format: KOB-YYYY-XXX</small>
                                        </div>

                                        <div class="col-md-6">
    <label for="classe_id" class="form-label">Classe <span class="text-danger">*</span></label>
    <select class="form-select" id="classe_id" name="classe_id" required>
        <option value="">-- Sélectionner une classe --</option>
        @foreach($classes as $classe)
            <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
        @endforeach
    </select>
</div>

                                        <div class="col-md-6">
                                            <label for="date_inscription" class="form-label">Date d'inscription <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="date_inscription" name="date_inscription" value="{{ old('date_inscription') }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="annee_scolaire" class="form-label">Année scolaire <span class="text-danger">*</span></label>
                                            <select class="form-select" id="annee_scolaire" name="annee_scolaire" required>
                                                <option value="">-- Sélectionner --</option>
                                                <option value="2023-2024" {{ old('2023-2024') == 'M' ? 'selected' : '' }}>2023-2024</option>
                                                <option value="2024-2025"  {{ old('2024-2025') == 'M' ? 'selected' : '' }}selected>2024-2025</option>
                                                <option value="2025-2026" {{ old('2025-2026') == 'M' ? 'selected' : '' }}>2025-2026</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations du parent/tuteur -->
                            <div class="card mb-4">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="bi bi-people"></i> Informations du Parent/Tuteur</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="nom_parent" class="form-label">Nom complet du parent <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nom_parent" name="nom_parent" 
                                                   placeholder="Ex: Kouassi André" value="{{ old('nom_parent') }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="lien_parente" class="form-label">Lien de parenté <span class="text-danger">*</span></label>
                                            <select class="form-select" id="lien_parente" name="lien_parente" required>
                                                <option value="">-- Sélectionner --</option>
                                                <option value="Pere" {{ old('genre') == 'Pere' ? 'selected' : '' }}>Père</option>
                                                <option value="Mere" {{ old('genre') == 'Mere' ? 'selected' : '' }}>Mère</option>
                                                <option value="Tuteur" {{ old('genre') == 'Tuteur' ? 'selected' : '' }}>Tuteur</option>
                                                <option value="Autre" {{ old('genre') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="telephone_parent" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" id="telephone_parent" name="telephone_parent" 
                                                   placeholder="Ex: +229 97 12 34 56" value="{{ old('telephone_parent') }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email_parent" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email_parent" name="email_parent" 
                                                   placeholder="Ex: parent@email.com" value="{{ old('email_parent') }}">
                                        </div>

                                        <div class="col-12">
                                            <label for="profession_parent" class="form-label">Profession du parent</label>
                                            <input type="text" class="form-control" id="profession_parent" name="profession_parent" 
                                                   placeholder="Ex: Enseignant" value="{{ old('profession_parent') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Colonne droite -->
                        <div class="col-md-4">
                            <!-- Photo de l'élève -->
                            <div class="card mb-4">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0"><i class="bi bi-camera"></i> Photo de l'élève</h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <img id="photo-preview" src="https://via.placeholder.com/200x200?text=Photo+Eleve" 
                                             alt="Photo élève" class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                    </div>
                                    <input type="file" class="form-control" id="photo" name="photo" 
                                           accept="image/*" onchange="previewPhoto(event)" value="{{ old('photo') }}">
                                    <small class="text-muted">Format: JPG, PNG (Max 2MB)</small>
                                </div>
                            </div>

                            <!-- Informations supplémentaires -->
                            <div class="card mb-4">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informations Médicales</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="groupe_sanguin" class="form-label">Groupe sanguin</label>
                                        <select class="form-select" id="groupe_sanguin" name="groupe_sanguin">
                                            <option value="">-- Sélectionner --</option>
                                            <option value="A+" {{ old('genre') == 'A+' ? 'selected' : '' }}>A+</option>
                                            <option value="A-" {{ old('genre') == 'A-' ? 'selected' : '' }}>A-</option>
                                            <option value="B+" {{ old('genre') == 'B+' ? 'selected' : '' }}>B+</option>
                                            <option value="B-" {{ old('genre') == 'B-' ? 'selected' : '' }}>B-</option>
                                            <option value="AB+" {{ old('genre') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                            <option value="AB-" {{ old('genre') == 'A-' ? 'selected' : '' }}>AB-</option>
                                            <option value="O+" {{ old('genre') == 'O+' ? 'selected' : '' }}>O+</option>
                                            <option value="O-" {{ old('genre') == 'O-' ? 'selected' : '' }}>O-</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="allergies" class="form-label">Allergies</label>
                                        <textarea class="form-control" id="allergies" name="allergies" rows="2" 
                                                  placeholder="Aucune ou préciser...">{{ old('allergies') }}</textarea>
                                    </div>

                                    <div class="mb-0">
                                        <label for="observations" class="form-label">Observations</label>
                                        <textarea class="form-control" id="observations" name="observations" rows="3" 
                                                  placeholder="Notes supplémentaires...">{{ old('observations') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="bi bi-save"></i> Enregistrer l'élève
                                        </button>
                                        <a href="/students" class="btn btn-outline-secondary">
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

    // Auto-générer le matricule (exemple simple)
    window.addEventListener('DOMContentLoaded', function() {
        const year = new Date().getFullYear();
        const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
        document.getElementById('matricule').value = `KOB-${year}-${random}`;
    });
</script>
@endsection
@endsection