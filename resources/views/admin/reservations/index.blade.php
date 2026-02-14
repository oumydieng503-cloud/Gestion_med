@extends('layouts.admin')

@section('content')
<h1>Liste des reservations</h1>
{{--<a href="{{ route('admin.reservations.create') }}" class="btn btn-primary mb-3">Ajouter une reservation</a>--}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Patient</th>
            <th>service</th>
            <th>date_reservation</th>
            <th>heure_reservation</th>
            <th>medecin</th>
            <th>statut</th>
            <th>commentaire</th>
            <th>Actions</th>
            
            

        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $reservation)
        <tr>
            <td>{{ $reservation->patient->name ?? 'Patient supprimé' }}</td>
            <td>{{ $reservation->service->titre ?? 'Service supprimé' }}</td>
            <td>{{ $reservation->date_reservation }}</td>
            <td>{{ $reservation->heure_reservation }}</td>
            <td> {{ $reservation->medecin->name ?? 'Non attribué' }}</td>
          {{--  <td>{{ $reservation->patient->medecin->name ?? 'Non attribué' }}</td>--}}
            <td>{{ $reservation->statut }}</td>
            <td>{{ $reservation->commentaire }}</td>
             
            <td>
                <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-sm btn-warning">Editer</a>
                <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection