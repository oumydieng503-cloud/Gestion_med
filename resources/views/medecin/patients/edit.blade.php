@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Modifier patient</h1>

<div class="card shadow">
    <div class="card-body">
        <form method="POST" action="{{ route('patients.update', $patient) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" value="{{ $patient->nom }}" required>
            </div>

            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" value="{{ $patient->prenom }}" required>
            </div>

            <div class="form-group">
                <label>Téléphone</label>
                <input type="text" name="telephone" class="form-control" value="{{ $patient->telephone }}">
            </div>

            <div class="form-group">
                <label>Adresse</label>
                <input type="text" name="adresse" class="form-control" value="{{ $patient->adresse }}">
            </div>

            <button class="btn btn-success">
                <i class="fas fa-check"></i> Mettre à jour
            </button>

            <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                Retour
            </a>
        </form>
    </div>
</div>

@endsection
