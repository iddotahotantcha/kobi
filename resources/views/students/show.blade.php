@extends('layouts.app')

@section('title', 'Détails de l\'élève')

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
                        <a class="nav-link active" href="{{ route('students.index') }}">
                            <i class="bi bi-people"></i> Élèves
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teachers.index') }}">
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
                        <h2 class="mb-0"><i class="bi bi-person"></i> Fiche de l'élève</h2>
                        <p class="text-muted">Informations détaillées de l'élève</p>
                    </div>
                    <div>
                        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Retour à la liste
                        </a>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')">
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
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-person"></i> Informations Personnelles</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Matricule</label>
                                        <p class="fw-bold">{{ $student->matricule }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Nom complet</label>
                                        <p class="fw-bold">{{ $student->full_name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Date de naissance</label>
                                        <p class="fw-bold">{{ $student->date_naissance->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Lieu de naissance</label>
                                        <p class="fw-bold">{{ $student->lieu_naissance }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Genre</label>
                                        <p class="fw-bold">
                                            <span class="badge {{ $student->genre == 'M' ? 'bg-info' : 'bg-danger' }}">
                                                {{ $student->genre == 'M' ? 'Masculin' : 'Féminin' }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Nationalité</label>
                                        <p class="fw-bold">{{ $student->nationalite }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="text-muted small">Adresse</label>
                                        <p class="fw-bold">{{ $student->adresse }}</p>
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
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Classe</label>
                                        <p class="fw-bold">
                                            <span class="badge bg-primary fs-6">{{ $student->classe->nom }}</span>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Date d'inscription</label>
                                        <p class="fw-bold">{{ $student->date_inscription->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Année scolaire</label>
                                        <p class="fw-bold">{{ $student->annee_scolaire }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informations du parent -->
                        <div class="card mb-4">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0"><i class="bi bi-people"></i> Informations du Parent/Tuteur</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Nom du parent</label>
                                        <p class="fw-bold">{{ $student->nom_parent }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Lien de parenté</label>
                                        <p class="fw-bold">{{ $student->lien_parente }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Téléphone</label>
                                        <p class="fw-bold">
                                            <a href="tel:{{ $student->telephone_parent }}">{{ $student->telephone_parent }}</a>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Email</label>
                                        <p class="fw-bold">
                                            @if($student->email_parent)
                                                <a href="mailto:{{ $student->email_parent }}">{{ $student->email_parent }}</a>
                                            @else
                                                <span class="text-muted">Non renseigné</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="text-muted small">Profession</label>
                                        <p class="fw-bold">{{ $student->profession_parent ?? 'Non renseignée' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informations médicales -->
                        <div class="card mb-4">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0"><i class="bi bi-heart-pulse"></i> Informations Médicales</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Groupe sanguin</label>
                                        <p class="fw-bold">{{ $student->groupe_sanguin ?? 'Non renseigné' }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="text-muted small">Allergies</label>
                                        <p class="fw-bold">{{ $student->allergies ?? 'Aucune' }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="text-muted small">Observations</label>
                                        <p class="fw-bold">{{ $student->observations ?? 'Aucune observation' }}</p>
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
                                @if($student->photo)
                                    <img src="{{ asset('storage/' . $student->photo) }}" 
                                         alt="Photo de {{ $student->full_name }}" 
                                         class="img-fluid rounded" style="max-height: 300px;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($student->full_name) }}&size=300&background=random&color=fff" 
                                         alt="Photo de {{ $student->full_name }}" 
                                         class="img-fluid rounded">
                                @endif
                            </div>
                        </div>

                        <!-- Métadonnées -->
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Métadonnées</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <small class="text-muted">Ajouté le :</small><br>
                                    <strong>{{ $student->created_at->format('d/m/Y à H:i') }}</strong>
                                </p>
                                <p class="mb-0">
                                    <small class="text-muted">Dernière modification :</small><br>
                                    <strong>{{ $student->updated_at->format('d/m/Y à H:i') }}</strong>
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