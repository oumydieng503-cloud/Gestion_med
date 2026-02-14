@extends('layouts.admin')

@section('content')
    <h1>Modifier une réservation</h1>

    <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary mb-3">Retour à la liste</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label>date_reservation</label>
            <input type="date" name="date_reservation" class="form-control"
                value="{{ old('date_reservation', $reservation->date_reservation) }}" required>
        </div>

        <div class="form-group mb-3">
            <label>heure_reservation</label>
            <input type="time" name="heure_reservation" class="form-control"
                value="{{ old('heure_reservation', $reservation->heure_reservation) }}" required>
        </div>
        <div class="form-group mb-3">
            <label>commentaire</label>
            <input type="text" name="commentaire" class="form-control"
                value="{{ old('commentaire', $reservation->commentaire) }}" required>
        </div>

        <div class="form-group mb-3">
            <label>statut</label>
            <select name="statut" class="form-control" required>
                <option value="en_attente" {{ $reservation->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="confirmee" {{ $reservation->statut == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                <option value="annulee" {{ $reservation->statut == 'annulee' ? 'selected' : '' }}>Annulée</option>
                <option value="effectuee" {{ $reservation->statut == 'effectuee' ? 'selected' : '' }}>Effectuée</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label>Médecin</label>
            <select name="medecin_id" class="form-control">
                <option value="">-- Choisir un médecin --</option>

                @foreach($medecins as $medecin)
                    <option value="{{ $medecin->id }}" {{ $reservation->medecin_id == $medecin->id ? 'selected' : '' }}>
                        {{ $medecin->name }}
                    </option>
                @endforeach
            </select>
        </div>



        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
@endsection