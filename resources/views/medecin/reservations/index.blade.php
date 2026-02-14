@extends('layouts.admin')

@section('content')

<h3>Mes réservations</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Patient</th>
            <th>Service</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($reservations as $reservation)
        <tr>
            <td>{{ $reservation->patient->name ?? '—' }}</td>
            <td>{{ $reservation->service->titre ?? '—' }}</td>
            <td>
                {{ $reservation->date_reservation }}
                {{ $reservation->heure_reservation }}
            </td>
            <td>
                <span class="badge bg-info">
                    {{ $reservation->statut }}
                </span>
            </td>
            <td>
                {{-- Si en attente → confirmer --}}
                @if($reservation->statut === 'en_attente')
                    <form method="POST"
                          action="{{ route('medecin.reservations.updateStatus', $reservation->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="statut" value="confirmee">
                        <button class="btn btn-success btn-sm">
                            Confirmer
                        </button>
                    </form>
                @endif

                {{-- Si confirmée → marquer effectuée --}}
                @if($reservation->statut === 'confirmee')
                    <form method="POST"
                          action="{{ route('medecin.reservations.updateStatus', $reservation->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="statut" value="effectuee">
                        <button class="btn btn-primary btn-sm">
                            Marquer effectuée
                        </button>
                    </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">
                Aucune réservation trouvée.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
