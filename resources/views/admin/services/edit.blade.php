@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier le service</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.services.update', $service->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Nom du service</label>
            <input type="text"
                   name="titre"
                   class="form-control"
                   value="{{ old('titre', $service->titre) }}"
                   required>
        </div>

        <div class="form-group mb-3">
            <label>Prix</label>
            <input type="number"
                   name="prix"
                   class="form-control"
                   value="{{ old('prix', $service->prix) }}"
                   required>
        </div>

        <div class="form-group mb-3">
            <label>Description</label>
            <textarea name="description"
                      class="form-control"
                      rows="3">{{ old('description', $service->description) }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label>Durée (en minutes)</label>
            <input type="number"
                   name="duree"
                   class="form-control"
                   value="{{ old('duree', $service->duree) }}"
                   required>
        </div>
       <div class="form-group mb-3">
    <label>Médecin responsable</label>
    <select name="medecin_id" class="form-control" required>
        <option value="">-- Choisir un médecin --</option>
        @foreach($medecins as $medecin)
            <option value="{{ $medecin->id }}"
                {{ old('medecin_id', $service->medecin_id) == $medecin->id ? 'selected' : '' }}>
                {{ $medecin->name }}
            </option>
        @endforeach
    </select>
</div>

        <button type="submit" class="btn btn-primary">
            Mettre à jour
        </button>

        <a href="{{ route('admin.services.index') }}"
           class="btn btn-secondary">
            Annuler
        </a>
    </form>
</div>
@endsection
