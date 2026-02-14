@extends('layouts.admin')

@section('content')
<h1>Mes services</h1>



<table class="table table-bordered">
    <tr>
        <th>Titre</th>
        <th>Prix</th>
        <th>Durée</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>

    @foreach($services as $service)
    <tr>
        <td>{{ $service->titre }}</td>
        <td>{{ $service->prix }} FCFA</td>
        <td>{{ $service->duree }} min</td>
        <td>{{ $service->description }}</td>
        <td>
            {{-- Boutons admin/medecin --}}
            <a href="{{ route('medecin.services.edit', $service) }}" class="btn btn-warning btn-sm">✏️</a>
            <form action="{{ route('medecin.services.destroy', $service) }}" method="POST" style="display:inline">
                @csrf 
                @method('DELETE')
                <button class="btn btn-danger btn-sm">🗑️</button>
            </form>

            {{-- Bouton Réserver visible pour tout le monde --}}
            <a href="{{ route('reservations.create', $service->id) }}" class="btn btn-primary btn-sm mt-1">
                Réserver
            </a>
        </td>
    </tr>
    @endforeach
</table>

@endsection
