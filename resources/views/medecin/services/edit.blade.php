@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Modifier un service</h1>

<div class="card shadow">
    <div class="card-body">
        <form method="POST" action="{{ route('medecin.services.update', $service) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Titre</label>
                <input type="text" name="titre" class="form-control" value="{{ $service->titre }}" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" value="{{ $service->description }}" required>
            </div>

            <div class="form-group">
                <label>Prix</label>
                <input type="number" name="prix" class="form-control" value="{{ $service->prix }}" required>
            </div>

            <div class="form-group">
                <label>Durée (en minutes)</label>
                <input type="number" name="duree" class="form-control" value="{{ $service->duree }}">
            </div>

            <button class="btn btn-success">
                <i class="fas fa-check"></i> Mettre à jour
            </button>

            <a href="{{ route('medecin.services.index') }}" class="btn btn-secondary">
                Retour
            </a>
        </form>
    </div>
</div>

@endsection
