<!-- resources/views/locations/index.blade.php -->

@extends("admin.base.base")

@section('content-admin')
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
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->user->name }}</td>
                        <td>{{ $reservation->vehicule->name }}</td>
                        <td>{{ $reservation->start_date }}</td>
                        <td>{{ $reservation->end_date }}</td>
                        <td>{{ $reservation->total_price }} €</td>
                        <td>{{ ucfirst($reservation->status) }}</td>
                        <td>
                            <a href="{{ route('reservation.show', $reservation->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($reservations->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">
                            <p>Aucune réservation trouvée.</p>
                        </td>
                    </tr>

                @endif
            </tbody>
        </table>

</div>
@endsection
