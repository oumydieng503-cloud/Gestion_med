@extends('layouts.admin')

@section('content')

<h2>Réserver un service</h2>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('reservations.store') }}" method="POST">
    @csrf

    <input type="hidden" name="service_id" value="{{ $service->id }}">

    <div class="form-group">
        <label>Date</label>
        <input type="date" name="date_reservation" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Heure</label>
        <input type="time" name="heure_reservation" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Commentaire</label>
        <textarea name="commentaire" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Réserver
    </button>
</form>

@endsection
