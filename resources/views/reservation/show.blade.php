@extends("admin.base.base")

@section('content')
<div class="container">
    <h1>Détails de la réservation</h1>

    <div class="card">
        <div class="card-header">
            Réservation #{{ $location->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Informations sur la réservation</h5>
            <p class="card-text"><strong>Utilisateur :</strong> {{ $location->user->name }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $location->vehicle->name }}</p>
            <p class="card-text"><strong>Date de début :</strong> {{ $location->start_date }}</p>
            <p class="card-text"><strong>Date de fin :</strong> {{ $location->end_date }}</p>
            <p class="card-text"><strong>Prix total :</strong> {{ number_format($location->total_price, 2, ',', ' ') }} €</p>
            <p class="card-text"><strong>Status :</strong> {{ $location->status }}</p> <!-- Si vous avez un champ de statut -->

            <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('locations.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
