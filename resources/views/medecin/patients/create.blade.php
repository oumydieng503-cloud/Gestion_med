@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Ajouter un patient</h1>

<div class="card shadow">
    <div class="card-body">
        <form method="POST" action="{{ route('medecin.patients.store') }}">
            @csrf

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Téléphone</label>
                <input type="text" name="telephone" class="form-control">
            </div>

            <div class="form-group">
                <label>Adresse</label>
                <input type="text" name="adresse" class="form-control">
            </div>

            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Enregistrer
            </button>

            <a href="{{ route('medecin.patients.index') }}" class="btn btn-secondary">
                Annuler
            </a>
        </form>
    </div>
</div>

@endsection
