@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Gestion des services</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">
➕ Nouveau service
</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Médecin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td>{{ $service->titre }}</td>
                    <td>{{ $service->prix }}</td>
                    <td>
                        {{ $service->medecin->name ?? 'Non attribué' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service->id) }}"
                           class="btn btn-sm btn-warning">
                            Modifier
                        </a>

                        <form action="{{ route('admin.services.destroy', $service->id) }}"
                              method="POST"
                              style="display:inline-block"
                              onsubmit="return confirm('Supprimer ce service ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucun service trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
