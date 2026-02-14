@extends('layouts.admin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Mes patients</h1>
    <a href="{{ route('medecin.patients.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Ajouter un patient
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->nom }}</td>
                        <td>{{ $patient->prenom }}</td>
                        <td>{{ $patient->telephone }}</td>
                        <td>{{ $patient->adresse }}</td>
                        <td class="text-center">
                            <a href="{{ route('medecin.patients.edit', $patient) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('medecin.patients.destroy', $patient) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Supprimer ce patient ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if($patients->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Aucun patient enregistré
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
