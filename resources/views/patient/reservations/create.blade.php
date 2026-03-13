{{-- resources/views/patient/reservations/create.blade.php --}}
@extends('layouts.admin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Réserver : {{ $service->nom }}</h1>
</div>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->id }}">

            {{-- ===== SECTION PROFIL PATIENT ===== --}}
            {{-- On affiche une bannière si le profil est incomplet --}}
            @if(!$profil || !$profil->telephone)
                <div class="alert alert-info">
                    📋 Complétez votre profil pour finaliser la réservation.
                </div>
            @else
                <div class="alert alert-success">
                    ✅ Profil pré-rempli — vous pouvez modifier si nécessaire.
                </div>
            @endif

            <h5 class="text-primary mb-3">Vos informations</h5>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                        value="{{ old('nom', $profil->nom ?? '') }}" required>
                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                        value="{{ old('prenom', $profil->prenom ?? '') }}" required>
                    @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>Téléphone <span class="text-danger">*</span></label>
                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                        value="{{ old('telephone', $profil->telephone ?? '') }}" required>
                    @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>Adresse <span class="text-danger">*</span></label>
                    <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror"
                        value="{{ old('adresse', $profil->adresse ?? '') }}" required>
                    @error('adresse') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <hr>

            {{-- ===== SECTION RÉSERVATION ===== --}}
            <h5 class="text-primary mb-3">Détails du rendez-vous</h5>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Date <span class="text-danger">*</span></label>
                    <input type="date" name="date_reservation"
                        class="form-control @error('date_reservation') is-invalid @enderror"
                        value="{{ old('date_reservation') }}" required>
                    @error('date_reservation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>Heure <span class="text-danger">*</span></label>
                    <input type="time" name="heure_reservation"
                        class="form-control @error('heure_reservation') is-invalid @enderror"
                        value="{{ old('heure_reservation') }}" required>
                    @error('heure_reservation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 form-group">
                    <label>Commentaire</label>
                    <textarea name="commentaire" class="form-control" rows="3">{{ old('commentaire') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                Confirmer la réservation
            </button>
        </form>
    </div>
</div>

@endsection
