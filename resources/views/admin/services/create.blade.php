@extends('layouts.admin')

@section('content')
<h1>Ajouter un service</h1>

<form method="POST" action="{{ route('admin.services.store') }}">
@csrf

<div class="form-group">
    <label>Titre</label>
    <input type="text" name="titre" class="form-control" required>
</div>

<div class="form-group">
    <label>Description</label>
    <textarea name="description" class="form-control"></textarea>
</div>

<div class="form-group">
    <label>Prix</label>
    <input type="number" name="prix" class="form-control" required>
</div>

<div class="form-group">
    <label>Durée (minutes)</label>
    <input type="number" name="duree" class="form-control" required>
</div>

<div class="form-group">
<label>Médecin</label>
<select name="medecin_id" class="form-control" required>
@foreach($medecins as $medecin)
<option value="{{ $medecin->id }}">
{{ $medecin->name }}
</option>
@endforeach
</select>
</div>

<button class="btn btn-success mt-3">Enregistrer</button>
</form>
@endsection
