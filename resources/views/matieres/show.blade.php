@extends('layouts.app')

@section('title', 'Détails de la Matière')

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
                        <a class="nav-link" href="{{ route('classes.index') }}">
                            <i class="bi bi-building"></i> Classes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('matieres.index') }}">
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
                        <h2 class="mb-0"><i class="bi bi-book"></i> {{ $matiere->nom }}</h2>
                        <p class="text-muted">Détails et gestion de la matière</p>
                    </div>
                    <div>
                        <a href="{{ route('matieres.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                        <a href="{{ route('matieres.edit', $matiere) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <form action="{{ route('matieres.destroy', $matiere) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette matière ?')">
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
                        <!-- Informations de la matière -->
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informations de la matière</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label class="text-muted small">Nom de la matière</label>
                                        <p class="fw-bold fs-4">{{ $matiere->nom }}</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="text-muted small">Code</label>
                                        <p class="fw-bold"><span class="badge bg-primary fs-6">{{ $matiere->code }}</span></p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="text-muted small">Description</label>
                                        <p class="fw-bold">{{ $matiere->description ?? 'Aucune description' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Liste des enseignants -->
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="bi bi-person-badge"></i> Enseignants ({{ $matiere->teachers->count() }})</h5>
                            </div>
                            <div class="card-body p-0">
                                @if($matiere->teachers->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Photo</th>
                                                    <th>Nom complet</th>
                                                    <th>Classe assignée</th>
                                                    <th>Email</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($matiere->teachers as $teacher)
                                                    <tr>
                                                        <td>
                                                            @if($teacher->photo)
                                                                <img src="{{ asset('storage/' . $teacher->photo) }}" 
                                                                     alt="Photo" class="rounded-circle" width="35" height="35">
                                                            @else
                                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($teacher->full_name) }}&background=random" 
                                                                     alt="Photo" class="rounded-circle" width="35" height="35">
                                                            @endif
                                                        </td>
                                                        <td>{{ $teacher->full_name }}</td>
                                                        <td>
                                                            @if($teacher->classe)
                                                                <span class="badge bg-primary">{{ $teacher->classe->nom }}</span>
                                                            @else
                                                                <span class="badge bg-secondary">Non assigné</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $teacher->user->email }}</td>
                                                        <td>
                                                            <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-sm btn-outline-primary">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="bi bi-inbox fs-1 text-muted"></i>
                                        <p class="text-muted mt-2">Aucun enseignant n'enseigne cette matière</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Liste des classes -->
                        <div class="card mb-4">
                            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="bi bi-building"></i> Classes ({{ $matiere->classes->count() }})</h5>
                            </div>
                            <div class="card-body">
                                @if($matiere->classes->count() > 0)
                                    <div class="row">
                                        @foreach($matiere->classes as $classe)
                                            <div class="col-md-6 mb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h6 class="mb-1">{{ $classe->nom }}</h6>
                                                                <small class="text-muted">{{ $classe->niveau }}</small>
                                                            </div>
                                                            <div>
                                                                <span class="badge bg-info">Coef: {{ $classe->pivot->coefficient }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-3">
                                        <i class="bi bi-inbox fs-3 text-muted"></i>
                                        <p class="text-muted mb-0">Cette matière n'est pas encore attribuée à des classes</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Colonne droite -->
                    <div class="col-md-4">
                        <!-- Statistiques -->
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0"><i class="bi bi-graph-up"></i> Statistiques</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <i class="bi bi-person-badge text-success"></i> 
                                    <strong>Enseignants:</strong> 
                                    {{ $matiere->teachers->count() }}
                                </p>
                                <p class="mb-2">
                                    <i class="bi bi-building text-warning"></i> 
                                    <strong>Classes:</strong> 
                                    {{ $matiere->classes->count() }}
                                </p>
                                <hr>
                                <p class="mb-0 text-muted small">
                                    Cette matière est enseignée dans {{ $matiere->classes->count() }} classe(s) 
                                    par {{ $matiere->teachers->count() }} enseignant(s).
                                </p>
                            </div>
                        </div>

                        <!-- Métadonnées -->
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Informations</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <small class="text-muted">Créée le:</small><br>
                                    <strong>{{ $matiere->created_at->format('d/m/Y à H:i') }}</strong>
                                </p>
                                <p class="mb-0">
                                    <small class="text-muted">Dernière modification:</small><br>
                                    <strong>{{ $matiere->updated_at->format('d/m/Y à H:i') }}</strong>
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