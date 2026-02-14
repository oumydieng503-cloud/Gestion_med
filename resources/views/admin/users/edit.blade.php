@extends('layouts.admin')

@section('content')
<h1>Modifier utilisateur</h1>

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
@if($user->role === 'patient')
<div class="form-group">
    <label>Médecin</label>
    <select name="medecin_id" class="form-control">
        <option value="">-- Choisir un médecin --</option>
        @foreach($medecins as $medecin)
            <option value="{{ $medecin->id }}"
                {{ $user->medecin_id == $medecin->id ? 'selected' : '' }}>
                {{ $medecin->name }}
            </option>
        @endforeach
    </select>
</div>
@endif


<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label>Nom</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="form-group mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="form-group mb-3">
        <label>Role</label>
        <select name="role" class="form-control" required>
            <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
            <option value="medecin" {{ $user->role=='medecin' ? 'selected' : '' }}>Médecin</option>
            <option value="patient" {{ $user->role=='patient' ? 'selected' : '' }}>Patient</option>
        </select>
    </div>
    

    <button type="submit" class="btn btn-success">Mettre à jour</button>
</form>
@endsection
