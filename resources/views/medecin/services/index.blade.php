@extends('layouts.admin')

@section('content')
<h1>Mes services</h1>



<table class="table table-bordered">
    <tr>
        <th>Titre</th>
        <th>Prix</th>
        <th>Durée</th>
        <th>Description</th>
    </tr>

    @foreach($services as $service)
    <tr>
        <td>{{ $service->titre }}</td>
        <td>{{ $service->prix }} FCFA</td>
        <td>{{ $service->duree }} min</td>
        <td>{{ $service->description }}</td>
        
    </tr>
    @endforeach
</table>

@endsection
