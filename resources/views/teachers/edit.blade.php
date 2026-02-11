@extends('layouts.app')

@section('title', 'Modifier un Enseignant')

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
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger" style="border: none; background: none; cursor: pointer;">
                                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                                </button>
                            </form>
                        </li>
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
                        <h2 class="mb-0"><i class="bi bi-pencil"></i> Modifier un Enseignant</h2>
                        <p class="text-muted">Modifiez les informations de l'enseignant</p>
                    </div>
                    <div>
                        <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary">
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
                <form action="{{ route('teachers.update', $teacher) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
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
                                                   value="{{ old('nom', $teacher->nom) }}" placeholder="Ex: Dupont" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="prenom" class="form-label">Prénom(s) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="prenom" name="prenom" 
                                                   value="{{ old('prenom', $teacher->prenom) }}" placeholder="Ex: Pierre Jean" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" 
                                                   value="{{ old('date_naissance', \Carbon\Carbon::parse($teacher->date_naissance)->format('Y-m-d')) }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="lieu_naissance" class="form-label">Lieu de naissance <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" 
                                                   value="{{ old('lieu_naissance', $teacher->lieu_naissance) }}" placeholder="Ex: Cotonou" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="genre" class="form-label">Genre <span class="text-danger">*</span></label>
                                            <select class="form-select" id="genre" name="genre" required>
                                                <option value="">-- Sélectionner --</option>
                                                <option value="M" {{ old('genre', $teacher->genre) == 'M' ? 'selected' : '' }}>Masculin</option>
                                                <option value="F" {{ old('genre', $teacher->genre) == 'F' ? 'selected' : '' }}>Féminin</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="nationalite" class="form-label">Nationalité <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nationalite" name="nationalite" 
                                                   value="{{ old('nationalite', $teacher->nationalite) }}" placeholder="Ex: Béninoise" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" id="telephone" name="telephone" 
                                                   value="{{ old('telephone', $teacher->telephone) }}" placeholder="Ex: +229 97 12 34 56" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" 
                                                   value="{{ old('email', $teacher->user->email) }}" placeholder="Ex: enseignant@kobi.school" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="adresse" class="form-label">Adresse complète <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="adresse" name="adresse" rows="2" 
                                                      placeholder="Ex: Quartier Akpakpa, Rue 123" required>{{ old('adresse', $teacher->adresse) }}</textarea>
                                        </div>
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
                                                   value="{{ old('matricule', $teacher->matricule) }}" required readonly>
                                            <small class="text-muted">Format: ENS-YYYY-XXX</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="diplome" class="form-label">Diplôme <span class="text-danger">*</span></label>
                                            <select class="form-select" id="diplome" name="diplome" required>
                                                <option value="">-- Sélectionner --</option>
                                                <option value="Licence" {{ old('diplome', $teacher->diplome) == 'Licence' ? 'selected' : '' }}>Licence</option>
                                                <option value="Master" {{ old('diplome', $teacher->diplome) == 'Master' ? 'selected' : '' }}>Master</option>
                                                <option value="Doctorat" {{ old('diplome', $teacher->diplome) == 'Doctorat' ? 'selected' : '' }}>Doctorat</option>
                                                <option value="CAP" {{ old('diplome', $teacher->diplome) == 'CAP' ? 'selected' : '' }}>CAP Enseignement</option>
                                                <option value="Autre" {{ old('diplome', $teacher->diplome) == 'Autre' ? 'selected' : '' }}>Autre</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
    <label for="matiere_id" class="form-label">Matière enseignée <span class="text-danger">*</span></label>
    <select class="form-select @error('matiere_id') is-invalid @enderror" 
            id="matiere_id" name="matiere_id" required>
        <option value="">-- Sélectionner une matière --</option>
        @foreach($matieres as $matiere)
            <option value="{{ $matiere->id }}" {{ old('matiere_id', $teacher->matiere_id) == $matiere->id ? 'selected' : '' }}>
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
                                                   value="{{ old('annees_experience', $teacher->annees_experience) }}" placeholder="Ex: 5" min="0">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="date_embauche" class="form-label">Date d'embauche <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="date_embauche" name="date_embauche" 
                                                   value="{{ old('date_embauche', \Carbon\Carbon::parse($teacher->date_embauche)->format('Y-m-d')) }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="statut" class="form-label">Statut <span class="text-danger">*</span></label>
                                            <select class="form-select" id="statut" name="statut" required>
                                                <option value="actif" {{ old('statut', $teacher->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                                                <option value="inactif" {{ old('statut', $teacher->statut) == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                                <option value="conge" {{ old('statut', $teacher->statut) == 'conge' ? 'selected' : '' }}>En congé</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Assignment -->
                            <div class="card mb-4">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="bi bi-key"></i> Assignation</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label for="classe_id" class="form-label">Classe assignée</label>
                                            <select class="form-select" id="classe_id" name="classe_id">
                                                <option value="">-- Aucune classe --</option>
                                                @foreach($classes as $classe)
                                                    <option value="{{ $classe->id }}" {{ old('classe_id', $teacher->classe_id) == $classe->id ? 'selected' : '' }}>
                                                        {{ $classe->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">Laisser vide si pas encore assigné</small>
                                        </div>

                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                <i class="bi bi-info-circle"></i> 
                                                <strong>Note :</strong> Le nom d'utilisateur et le mot de passe ne peuvent pas être modifiés depuis cette page.
                                                L'enseignant peut changer son mot de passe après connexion.
                                            </div>
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
                                        @if($teacher->photo)
                                            <img id="photo-preview" src="{{ asset('storage/' . $teacher->photo) }}" 
                                                 alt="Photo enseignant" class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                        @else
                                            <img id="photo-preview" src="https://via.placeholder.com/200x200?text=Photo+Enseignant" 
                                                 alt="Photo enseignant" class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                        @endif
                                    </div>
                                    <input type="file" class="form-control" id="photo" name="photo" 
                                           accept="image/*" onchange="previewPhoto(event)">
                                    <small class="text-muted">Laisser vide pour conserver la photo actuelle</small>
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
                                        @if($teacher->cv)
                                            <p class="small text-muted">Actuel : <a href="{{ asset('storage/' . $teacher->cv) }}" target="_blank">Voir</a></p>
                                        @endif
                                        <input type="file" class="form-control" id="cv" name="cv" accept=".pdf">
                                        <small class="text-muted">Laisser vide pour conserver</small>
                                    </div>

                                    <div class="mb-0">
                                        <label for="diplome_file" class="form-label">Copie du diplôme</label>
                                        @if($teacher->diplome_file)
                                            <p class="small text-muted">Actuel : <a href="{{ asset('storage/' . $teacher->diplome_file) }}" target="_blank">Voir</a></p>
                                        @endif
                                        <input type="file" class="form-control" id="diplome_file" name="diplome_file" accept=".pdf,.jpg,.png">
                                        <small class="text-muted">Laisser vide pour conserver</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-warning btn-lg">
                                            <i class="bi bi-save"></i> Mettre à jour l'enseignant
                                        </button>
                                        <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary">
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
</script>
@endsection
@endsection