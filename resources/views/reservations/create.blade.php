@extends('layouts.admin') 

@section('content')
<h3>Réserver le service</h3>

<div class="card">
    <div class="card-body">
        <p><strong>Service :</strong> {{ $service->titre }}</p>

        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf

            <input type="hidden" name="service_id" value="{{ $service->id }}">

            <div class="form-group">
                <label>Date de réservation</label>
                <input type="date" name="date_reservation" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Heure de réservation</label>
                <input type="time" name="heure_reservation" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Commentaire (optionnel)</label>
                <textarea name="commentaire" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success mt-2">
                Confirmer la réservation
            </button>
        </form>
    </div>
</div>
@endsection
