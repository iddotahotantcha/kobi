@extends('layouts.app')

@section('title', 'Détails de la Classe')

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
                        <h2 class="mb-0"><i class="bi bi-building"></i> Classe {{ $classe->nom }}</h2>
                        <p class="text-muted">Détails et gestion de la classe</p>
                    </div>
                    <div>
                        <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                        <a href="{{ route('classes.edit', $classe) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <form action="{{ route('classes.destroy', $classe) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette classe ?')">
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
                        <!-- Informations de la classe -->
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informations de la classe</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Nom de la classe</label>
                                        <p class="fw-bold fs-4">{{ $classe->nom }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Niveau</label>
                                        <p class="fw-bold"><span class="badge bg-info fs-6">{{ $classe->niveau }}</span></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Salle</label>
                                        <p class="fw-bold">{{ $classe->salle }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Capacité</label>
                                        <p class="fw-bold">{{ $classe->capacite }} élèves</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Effectif actuel</label>
                                        <p class="fw-bold">{{ $classe->effectif }} élèves</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small">Taux de remplissage</label>
                                        @php
                                            $percentage = $classe->capacite > 0 ? ($classe->effectif / $classe->capacite) * 100 : 0;
                                        @endphp
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar {{ $percentage < 50 ? 'bg-success' : ($percentage < 80 ? 'bg-warning' : 'bg-danger') }}" 
                                                 role="progressbar" style="width: {{ $percentage }}%">
                                                {{ round($percentage) }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Liste des élèves -->
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="bi bi-people"></i> Élèves ({{ $classe->students->count() }})</h5>
                                <a href="{{ route('students.create') }}" class="btn btn-sm btn-light">
                                    <i class="bi bi-plus"></i> Ajouter un élève
                                </a>
                            </div>
                            <div class="card-body p-0">
                                @if($classe->students->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Photo</th>
                                                    <th>Nom complet</th>
                                                    <th>Matricule</th>
                                                    <th>Genre</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($classe->students as $student)
                                                    <tr>
                                                        <td>
                                                            @if($student->photo)
                                                                <img src="{{ asset('storage/' . $student->photo) }}" 
                                                                     alt="Photo" class="rounded-circle" width="35" height="35">
                                                            @else
                                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($student->full_name) }}&background=random" 
                                                                     alt="Photo" class="rounded-circle" width="35" height="35">
                                                            @endif
                                                        </td>
                                                        <td>{{ $student->full_name }}</td>
                                                        <td><span class="badge bg-secondary">{{ $student->matricule }}</span></td>
                                                        <td>
                                                            <span class="badge {{ $student->genre == 'M' ? 'bg-info' : 'bg-danger' }}">
                                                                {{ $student->genre }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-primary">
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
                                        <p class="text-muted mt-2">Aucun élève dans cette classe</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Liste des enseignants -->
                        <div class="card mb-4">
                            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="bi bi-person-badge"></i> Enseignants ({{ $classe->teachers->count() }})</h5>
                            </div>
                            <div class="card-body">
                                @if($classe->teachers->count() > 0)
                                    @foreach($classe->teachers as $teacher)
                                        <div class="d-flex align-items-center mb-2">
                                            @if($teacher->photo)
                                                <img src="{{ asset('storage/' . $teacher->photo) }}" 
                                                     alt="Photo" class="rounded-circle me-3" width="50" height="50">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($teacher->full_name) }}&background=random" 
                                                     alt="Photo" class="rounded-circle me-3" width="50" height="50">
                                            @endif
                                            <div>
                                                <strong>{{ $teacher->full_name }}</strong><br>
                                                <small class="text-muted">{{ $teacher->user->email }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-3">
                                        <i class="bi bi-inbox fs-3 text-muted"></i>
                                        <p class="text-muted mb-0">Aucun enseignant assigné</p>
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
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Garçons</span>
                                        <strong>{{ $classe->students->where('genre', 'M')->count() }}</strong>
                                    </div>
                                    <div class="progress">
                                        @php
                                            $boys = $classe->students->where('genre', 'M')->count();
                                            $total = $classe->students->count();
                                            $boysPercent = $total > 0 ? ($boys / $total) * 100 : 0;
                                        @endphp
                                        <div class="progress-bar bg-info" style="width: {{ $boysPercent }}%"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Filles</span>
                                        <strong>{{ $classe->students->where('genre', 'F')->count() }}</strong>
                                    </div>
                                    <div class="progress">
                                        @php
                                            $girls = $classe->students->where('genre', 'F')->count();
                                            $girlsPercent = $total > 0 ? ($girls / $total) * 100 : 0;
                                        @endphp
                                        <div class="progress-bar bg-danger" style="width: {{ $girlsPercent }}%"></div>
                                    </div>
                                </div>

                                <hr>

                                <p class="mb-2">
                                    <i class="bi bi-calendar-check"></i> 
                                    <strong>Places disponibles:</strong> 
                                    {{ $classe->capacite - $classe->effectif }}
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
                                    <strong>{{ $classe->created_at->format('d/m/Y à H:i') }}</strong>
                                </p>
                                <p class="mb-0">
                                    <small class="text-muted">Dernière modification:</small><br>
                                    <strong>{{ $classe->updated_at->format('d/m/Y à H:i') }}</strong>
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