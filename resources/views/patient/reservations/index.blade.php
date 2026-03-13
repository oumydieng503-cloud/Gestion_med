@extends('layouts.admin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Mes réservations</h1>
    <a href="{{ route('patient.services.index') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nouvelle réservation
    </a>
</div>

{{-- Message succès / erreur --}}
@if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">❌ {{ session('error') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Médecin</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->service->titre ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->heure_reservation)->format('H:i') }}</td>
                        <td>
                            @if($reservation->medecin)
                                {{ $reservation->medecin->name }}
                            @else
                                <span class="text-muted">Non assigné</span>
                            @endif
                        </td>
                        <td>
                            @if($reservation->statut === 'en_attente')
                                <span class="badge badge-warning">⏳ En attente</span>
                            @elseif($reservation->statut === 'confirmee')
                                <span class="badge badge-success">✅ Confirmée</span>
                            @elseif($reservation->statut === 'annulee')
                                <span class="badge badge-danger">❌ Annulée</span>
                            @else
                                <span class="badge badge-primary">🏁 Effectuée</span>
                            @endif
                        </td>
                        <td>
                            {{-- ✅ Bouton annuler UNIQUEMENT si statut = en_attente --}}
                            {{-- Pourquoi ? On ne peut pas annuler ce qui est déjà confirmé ou effectué --}}
                            @if($reservation->statut === 'en_attente')
                                <form action="{{ route('reservations.cancel', $reservation->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Confirmer l\'annulation ?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-times"></i> Annuler
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Aucune réservation —
                            <a href="{{ route('patient.services.index') }}">Réserver maintenant</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection