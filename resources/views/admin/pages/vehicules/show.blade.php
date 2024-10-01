8@extends("admin.base.base")

@section('content-admins')
<div class="container">
    <h1>Détails des vehicules</h1>

    <div class="card">
        <div class="card-header">
            vehicule #{{ $vehicule->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Informations sur le vehicule</h5>
            <p class="card-text"><strong>Utilisateur :</strong> {{ $vehicule->user->name }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $vehicule->vehicule->make }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $vehicule->vehicule->modele }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $vehicule->vehicule->type_vehicule }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $vehicule->vehicule->location }}</p>
            <p class="card-text"><strong>Année :</strong> {{ $vehicule->year }}</p>
            <p class="card-text"><strong>Prix par jour :</strong> {{ number_format($vehicule->price_per_day, 2, ',', ' ') }} €</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $vehicule->vehicule->availability }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $vehicule->vehicule->description  }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $vehicule->vehicule->images }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $vehicule->vehicule->capacite }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $vehicule->vehicule->transmission }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $vehicule->vehicule->taille_coffre }}</p>
            <p class="card-text"><strong>Véhicule :</strong> {{ $vehicule->vehicule->consommation_moyenne }}</p>
            <p class="card-text"><strong>Date de fin :</strong> {{ $vehicule->vehicule->immatricule}}</p>
            <p class="card-text"><strong>Status :</strong> {{ $vehicule->status }}</p> <!-- Si vous avez un champ de statut -->
            <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('vehicules.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
