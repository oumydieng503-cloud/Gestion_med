@extends('layouts.admin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Mes patients</h1>
   
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Téléphone</th>
        <th>Adresse</th>
        <th>Email</th>
    </tr>
</thead>
<tbody>
    @forelse($patients as $reservation)
    <tr>
        {{-- Depuis la table patients (profil complet) --}}
        <td>{{ $reservation->user->patient->nom ?? $reservation->user->name }}</td>
        <td>{{ $reservation->user->patient->prenom ?? '-' }}</td>
        <td>{{ $reservation->user->patient->telephone ?? '-' }}</td>
        <td>{{ $reservation->user->patient->adresse ?? '-' }}</td>
        {{-- Depuis la table users --}}
        <td>{{ $reservation->user->email }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center text-muted">
            Aucun patient enregistré
        </td>
    </tr>
    @endforelse

                    @if($patients->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Aucun patient enregistré
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
