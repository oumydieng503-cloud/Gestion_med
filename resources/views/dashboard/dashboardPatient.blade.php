@extends('layouts.admin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bonjour {{ auth()->user()->name }} 👋</h1>
    <a href="{{ route('patient.services.index') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nouvelle réservation
    </a>
</div>

{{-- ===== LIGNE 1 : Stats ===== --}}
<div class="row">

    {{-- Total réservations --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Mes Réservations
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $stats['total_reservations'] }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- En attente --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            ⏳ En attente
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $stats['en_attente'] }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Confirmées --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            ✅ Confirmées
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $stats['confirmees'] }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ===== TABLEAU : Mes prochains rendez-vous ===== --}}
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Mes prochains rendez-vous</h6>
        <a href="{{ route('reservations.myReservations') }}" class="btn btn-sm btn-primary">
            Voir tout
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Service</th>
                        <th>Médecin</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats['mes_rdv'] as $r)
                    <tr>
                        <td>{{ $r->service->titre ?? '-' }}</td>
                        <td>{{ $r->medecin->name ?? 'Non assigné' }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->date_reservation)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->heure_reservation)->format('H:i') }}</td>
                        <td>
                            @if($r->statut === 'en_attente')
                                <span class="badge badge-warning">⏳ En attente</span>
                            @elseif($r->statut === 'confirmee')
                                <span class="badge badge-success">✅ Confirmée</span>
                            @elseif($r->statut === 'annulee')
                                <span class="badge badge-danger">❌ Annulée</span>
                            @else
                                <span class="badge badge-primary">🏁 Effectuée</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Aucun rendez-vous — 
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
