<!-- resources/views/locations/index.blade.php -->

@extends("admin.base.base")

@section('content')
<div class="container">
    <h1 class="my-4">Liste des Réservations de Véhicules</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('reservation.create') }}" class="btn btn-primary">Ajouter une Réservation</a>
    </div>

    @if($locations->isEmpty())
        <p>Aucune réservation trouvée.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Véhicule</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Prix total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $location)
                    <tr>
                        <td>{{ $location->id }}</td>
                        <td>{{ $location->user->name }}</td>
                        <td>{{ $location->vehicle->name }}</td>
                        <td>{{ $location->start_date }}</td>
                        <td>{{ $location->end_date }}</td>
                        <td>{{ $location->total_price }} €</td>
                        <td>{{ ucfirst($location->status) }}</td>
                        <td>
                            <a href="{{ route('reservation.show', $location->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('reservation.edit', $location->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('reservation.destroy', $location->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
