@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3>Mes réservations</h3>

        @if($reservations->isEmpty())
            <p>Aucune réservation trouvée.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Médecin</th>



                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->service->titre ?? '—' }}</td>
                            <td>{{ $reservation->date_reservation }}</td>
                            <td>{{ $reservation->statut }}</td>
                            <td>
                                @if($reservation->statut === 'confirmee' && $reservation->medecin)
                                    {{ $reservation->medecin->name }}
                                @else
                                    <span class="text-muted">En attente</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection