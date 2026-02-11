@extends('layouts.app')

@section('title', 'Détails de l\'enseignant')

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
                        <h2 class="mb-0"><i class="bi bi-person-badge"></i> Fiche de l'enseignant</h2>
                        <p class="text-muted">Informations détaillées de l'enseignant</p>
                    </div>
                    <div>
                        <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Retour à la liste
                        </a>
                        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <form action="{{ route('teachers.resend-credentials', $teacher) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-info">
                                <i class="bi bi-envelope"></i> Renvoyer identifiants
                            </button>
                        </form>
                        <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <!-- Colonne gauche -->
                    <div class="col-md-8">
                        <!-- Informations personnelles -->
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="bi bi-person"></i> Informations Personnelles</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Matricule</label>
                                        <p class="fw-bold">{{ $teacher->matricule }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Nom complet</label>
                                        <p class="fw-bold">{{ $teacher->full_name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Date de naissance</label>
                                        <p class="fw-bold">{{ \Carbon\Carbon::parse($teacher->date_naissance)->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Lieu de naissance</label>
                                        <p class="fw-bold">{{ $teacher->lieu_naissance }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Genre</label>
                                        <p class="fw-bold">
                                            <span class="badge {{ $teacher->genre == 'M' ? 'bg-info' : 'bg-danger' }}">
                                                {{ $teacher->genre == 'M' ? 'Masculin' : 'Féminin' }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Nationalité</label>
                                        <p class="fw-bold">{{ $teacher->nationalite }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Téléphone</label>
                                        <p class="fw-bold">
                                            <a href="tel:{{ $teacher->telephone }}">{{ $teacher->telephone }}</a>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Email</label>
                                        <p class="fw-bold">
                                            <a href="mailto:{{ $teacher->user->email }}">{{ $teacher->user->email }}</a>
                                        </p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="text-muted small">Adresse</label>
                                        <p class="fw-bold">{{ $teacher->adresse }}</p>
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
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Diplôme</label>
                                        <p class="fw-bold">{{ $teacher->diplome }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
    <label class="text-muted small">Matière enseignée</label>
    <p class="fw-bold">
        @if($teacher->matiere)
            <span class="badge bg-info fs-6">{{ $teacher->matiere->nom }}</span>
            <small class="text-muted">({{ $teacher->matiere->code }})</small>
        @else
            <span class="text-muted">Non définie</span>
        @endif
    </p>
</div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Années d'expérience</label>
                                        <p class="fw-bold">{{ $teacher->annees_experience ?? 'Non renseigné' }} 
                                            @if($teacher->annees_experience)
                                                {{ $teacher->annees_experience > 1 ? 'ans' : 'an' }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Date d'embauche</label>
                                        <p class="fw-bold">{{ \Carbon\Carbon::parse($teacher->date_embauche)->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Statut</label>
                                        <p class="fw-bold">
                                            @if($teacher->statut == 'actif')
                                                <span class="badge bg-success">Actif</span>
                                            @elseif($teacher->statut == 'inactif')
                                                <span class="badge bg-danger">Inactif</span>
                                            @else
                                                <span class="badge bg-warning text-dark">En congé</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Assignation et accès -->
                        <div class="card mb-4">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0"><i class="bi bi-key"></i> Assignation et Accès</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Classe assignée</label>
                                        <p class="fw-bold">
                                            @if($teacher->classe)
                                                <span class="badge bg-primary fs-6">{{ $teacher->classe->nom }}</span>
                                            @else
                                                <span class="badge bg-secondary">Non assignée</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Rôle</label>
                                        <p class="fw-bold">
                                            <span class="badge {{ $teacher->user->role == 'admin' ? 'bg-danger' : 'bg-info' }}">
                                                {{ $teacher->user->role == 'admin' ? 'Administrateur' : 'Éditeur (Enseignant)' }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Nom d'utilisateur</label>
                                        <p class="fw-bold">{{ $teacher->user->username }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Compte actif</label>
                                        <p class="fw-bold">
                                            @if($teacher->user->is_active)
                                                <span class="badge bg-success">Oui</span>
                                            @else
                                                <span class="badge bg-danger">Non</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents -->
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> Documents</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="text-muted small">CV</label>
                                        <p class="fw-bold">
                                            @if($teacher->cv)
                                                <a href="{{ asset('storage/' . $teacher->cv) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-download"></i> Télécharger
                                                </a>
                                            @else
                                                <span class="text-muted">Non fourni</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="text-muted small">Diplôme</label>
                                        <p class="fw-bold">
                                            @if($teacher->diplome_file)
                                                <a href="{{ asset('storage/' . $teacher->diplome_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-download"></i> Télécharger
                                                </a>
                                            @else
                                                <span class="text-muted">Non fourni</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="text-muted small">Autres documents</label>
                                        <p class="fw-bold">
                                            @if($teacher->autres_documents && count($teacher->autres_documents) > 0)
                                                {{ count($teacher->autres_documents) }} fichier(s)
                                            @else
                                                <span class="text-muted">Aucun</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Colonne droite -->
                    <div class="col-md-4">
                        <!-- Photo -->
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0"><i class="bi bi-camera"></i> Photo</h5>
                            </div>
                            <div class="card-body text-center">
                                @if($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" 
                                         alt="Photo de {{ $teacher->full_name }}" 
                                         class="img-fluid rounded" style="max-height: 300px;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($teacher->full_name) }}&size=300&background=random&color=fff" 
                                         alt="Photo de {{ $teacher->full_name }}" 
                                         class="img-fluid rounded">
                                @endif
                            </div>
                        </div>

                        <!-- Statistiques si classe assignée -->
                        @if($teacher->classe)
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-building"></i> Ma Classe</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <strong>Classe :</strong> {{ $teacher->classe->nom }}
                                </p>
                                <p class="mb-2">
                                    <strong>Niveau :</strong> {{ $teacher->classe->niveau }}
                                </p>
                                <p class="mb-2">
                                    <strong>Effectif :</strong> {{ $teacher->classe->effectif }} / {{ $teacher->classe->capacite }} élèves
                                </p>
                                <p class="mb-0">
                                    <strong>Salle :</strong> {{ $teacher->classe->salle }}
                                </p>
                            </div>
                        </div>
                        @endif

                        <!-- Métadonnées -->
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Métadonnées</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <small class="text-muted">Ajouté le :</small><br>
                                    <strong>{{ $teacher->created_at->format('d/m/Y à H:i') }}</strong>
                                </p>
                                <p class="mb-0">
                                    <small class="text-muted">Dernière modification :</small><br>
                                    <strong>{{ $teacher->updated_at->format('d/m/Y à H:i') }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection