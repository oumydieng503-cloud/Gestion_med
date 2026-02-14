@extends('layouts.admin') 

@section('content')
<h2>Liste des services</h2>

<div class="row">
@foreach($services as $service)
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $service->titre }}</h5>
                <p>{{ $service->description }}</p>

                @if(Auth::check() && Auth::user()->role === 'patient')
                    <a href="{{ route('reservations.create', $service->id) }}"
                       class="btn btn-success btn-sm">
                        Réserver
                    </a>
                @endif
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
