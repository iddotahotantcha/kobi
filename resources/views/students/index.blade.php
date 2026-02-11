@extends('layouts.app')

@section('title', 'Liste des Élèves')

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
                        <h2 class="mb-0"><i class="bi bi-people"></i> Gestion des Élèves</h2>
                        <p class="text-muted">Liste complète des élèves de l'école KOBI</p>
                    </div>
                    <div>
                        <a href="/students/create" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Ajouter un élève
                        </a>
                    </div>
                </div>

                <!-- Messages de succès -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

                <!-- Filtres et recherche -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="#" method="GET">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Rechercher</label>
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Nom, prénom, matricule...">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Classe</label>
                                    <select class="form-select" name="classe">
                                        <option value="">Toutes les classes</option>
                                        <option value="cp1">CP1</option>
                                        <option value="cp2">CP2</option>
                                        <option value="ce1">CE1</option>
                                        <option value="ce2">CE2</option>
                                        <option value="cm1">CM1</option>
                                        <option value="cm2">CM2</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Genre</label>
                                    <select class="form-select" name="genre">
                                        <option value="">Tous</option>
                                        <option value="M">Masculin</option>
                                        <option value="F">Féminin</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">&nbsp;</label>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i> Rechercher
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Statistiques rapides -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
    <div class="card border-primary">
        <div class="card-body text-center">
            <h3 class="text-primary mb-0">{{ $totalStudents }}</h3>
            <small class="text-muted">Total Élèves</small>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card border-success">
        <div class="card-body text-center">
            <h3 class="text-success mb-0">{{ $totalBoys }}</h3>
            <small class="text-muted">Garçons</small>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card border-danger">
        <div class="card-body text-center">
            <h3 class="text-danger mb-0">{{ $totalGirls }}</h3>
            <small class="text-muted">Filles</small>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card border-warning">
        <div class="card-body text-center">
            <h3 class="text-warning mb-0">{{ $totalClasses }}</h3>
            <small class="text-muted">Classes</small>
        </div>
    </div>
</div>
                </div>

                <!-- Table des élèves -->
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Liste des élèves (245)</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Matricule</th>
                                        <th>Nom complet</th>
                                        <th>Genre</th>
                                        <th>Date de naissance</th>
                                        <th>Classe</th>
                                        <th>Contact parent</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
    @forelse($students as $index => $student)
        <tr>
            <td>{{ $students->firstItem() + $index }}</td>
            <td>
                @if($student->photo)
                    <img src="{{ asset('storage/' . $student->photo) }}" 
                         alt="Photo" class="rounded-circle" width="40" height="40">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($student->full_name) }}&background=random&color=fff" 
                         alt="Photo" class="rounded-circle" width="40" height="40">
                @endif
            </td>
            <td><span class="badge bg-secondary">{{ $student->matricule }}</span></td>
            <td><strong>{{ $student->full_name }}</strong></td>
            <td><span class="badge {{ $student->genre == 'M' ? 'bg-info' : 'bg-danger' }}">{{ $student->genre }}</span></td>
            <td>{{ $student->date_naissance->format('d/m/Y') }}</td>
            <td><span class="badge bg-primary">{{ $student->classe->nom }}</span></td>
            <td>{{ $student->telephone_parent }}</td>
            <td>
                <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                    <i class="bi bi-eye"></i>
                </a>
                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-warning" title="Modifier">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center py-4">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <p class="text-muted mt-2">Aucun élève trouvé</p>
            </td>
        </tr>
    @endforelse
</tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Pagination -->
<div class="card-footer bg-white">
    {{ $students->links('pagination::bootstrap-5') }}
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection