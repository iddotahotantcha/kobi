@extends('layouts.app')

@section('title', 'Créer une Classe')

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
                        <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
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
                        <a class="nav-link" href="{{ route('teachers.index') }}">
                            <i class="bi bi-person-badge"></i> Enseignants
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('classes.index') }}">
                            <i class="bi bi-building"></i> Classes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('matieres.index') }}">
                            <i class="bi bi-book"></i> Matières
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-file-earmark-text"></i> Rapports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
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
                        <h2 class="mb-0"><i class="bi bi-plus-circle"></i> Créer une Classe</h2>
                        <p class="text-muted">Remplissez le formulaire pour créer une nouvelle classe</p>
                    </div>
                    <div>
                        <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary">
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
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-building"></i> Informations de la classe</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('classes.store') }}" method="POST">
                                    @csrf
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="nom" class="form-label">Nom de la classe <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                                   id="nom" name="nom" value="{{ old('nom') }}" 
                                                   placeholder="Ex: CP1-A, CM2-B" required>
                                            @error('nom')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Format recommandé : NIVEAU-LETTRE (ex: CP1-A)</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="niveau" class="form-label">Niveau <span class="text-danger">*</span></label>
                                            <select class="form-select @error('niveau') is-invalid @enderror" 
                                                    id="niveau" name="niveau" required>
                                                <option value="">-- Sélectionner un niveau --</option>
                                                <option value="CP1" {{ old('niveau') == 'CP1' ? 'selected' : '' }}>CP1 (Cours Préparatoire 1)</option>
                                                <option value="CP2" {{ old('niveau') == 'CP2' ? 'selected' : '' }}>CP2 (Cours Préparatoire 2)</option>
                                                <option value="CE1" {{ old('niveau') == 'CE1' ? 'selected' : '' }}>CE1 (Cours Élémentaire 1)</option>
                                                <option value="CE2" {{ old('niveau') == 'CE2' ? 'selected' : '' }}>CE2 (Cours Élémentaire 2)</option>
                                                <option value="CM1" {{ old('niveau') == 'CM1' ? 'selected' : '' }}>CM1 (Cours Moyen 1)</option>
                                                <option value="CM2" {{ old('niveau') == 'CM2' ? 'selected' : '' }}>CM2 (Cours Moyen 2)</option>
                                            </select>
                                            @error('niveau')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="salle" class="form-label">Salle <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('salle') is-invalid @enderror" 
                                                   id="salle" name="salle" value="{{ old('salle') }}" 
                                                   placeholder="Ex: Bâtiment A - Salle 12" required>
                                            @error('salle')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="capacite" class="form-label">Capacité maximale <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('capacite') is-invalid @enderror" 
                                                   id="capacite" name="capacite" value="{{ old('capacite', 30) }}" 
                                                   min="1" max="100" required>
                                            @error('capacite')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Nombre maximum d'élèves dans cette classe</small>
                                        </div>

                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                <i class="bi bi-info-circle"></i> 
                                                <strong>Note :</strong> L'effectif sera automatiquement mis à jour lorsque vous ajouterez des élèves à cette classe.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save"></i> Créer la classe
                                        </button>
                                        <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-x-circle"></i> Annuler
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection