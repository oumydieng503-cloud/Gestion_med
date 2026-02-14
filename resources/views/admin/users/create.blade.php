@extends('layouts.admin')

@section('content')
<h1>Ajouter un utilisateur</h1>

<a href="{{ route('admin.users.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="form-group mb-3">
        <label>Nom</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="form-group mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="form-group mb-3">
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Role</label>
        <select name="role" class="form-control" required>
            <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
            <option value="medecin" {{ old('role')=='medecin' ? 'selected' : '' }}>Médecin</option>
            <option value="patient" {{ old('role')=='patient' ? 'selected' : '' }}>Patient</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
@endsection
