@extends("admin.base.base")

@section('content')
<div class="container">
    <h1>Détails de la réservation</h1>

    <div class="card">
        <div class="card-header">
            Réservation #{{ $reservation->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Informations sur la réservation</h5>
            <p class="card-text"><strong>Utilisateur :</strong> {{ $reservation->user->name }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $reservation->vehicule->name }}</p>
            <p class="card-text"><strong>Date de début :</strong> {{ $reservation->start_date }}</p>
            <p class="card-text"><strong>Date de fin :</strong> {{ $reservation->end_date }}</p>
            <p class="card-text"><strong>Prix total :</strong> {{ number_format($reservation->total_price, 2, ',', ' ') }} €</p>
            <p class="card-text"><strong>Status :</strong> {{ $reservation->status }}</p> <!-- Si vous avez un champ de statut -->

            <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('reservation.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
