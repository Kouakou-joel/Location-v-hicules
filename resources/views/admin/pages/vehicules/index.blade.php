<!-- resources/views/locations/index.blade.php -->

@extends("admin.base.base")

@section('content-admin')
<div class="container">
    <h1 class="my-4">Liste des Véhicules</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('vehicules.create') }}" class="btn btn-primary">Ajouter un vehicule</a>
    </div>


        <table class="table table-bordered">
            <thead>
                <tr>
                    {{-- <th>ID</th> --}}
                    {{-- <th>Utilisateur</th> --}}
                    <th>Image</th>
                    <th>Marque</th>
                    <th>Type de vehicule</th>
                    <th>Modèle</th>
                    <th>Annnée</th>
                    <th>Prix par jour</th>
                    {{-- <th>Location</th> --}}
                    {{-- <th>Description</th> --}}
                    {{-- <th>Capacité</th> --}}
                    <th>Transmision</th>
                    {{-- <th>Taille de coffre</th> --}}
                    {{-- <th>Consommation moyenne</th> --}}
                    {{-- <th>Immatriculation</th> --}}
                    {{-- <th>Status</th> --}}
                    <th>Disponibilité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicules as $vehicule)
                    <tr>
                        {{-- <td>{{ $vehicule->id }}</td> --}}
                        {{-- <td>{{ $vehicule->user->name }}</td> --}}
                        <td>{{ $vehicule->vehicule->images }}</td>
                        <td>{{ $vehicule->vehicule->make }}</td>
                        <td>{{ $vehicule->vehicule->modele }}</td>
                        <td>{{ $vehicule->vehicule->type_vehicule }}</td>
                        <td>{{ $vehicule->year }}</td>
                        <td>{{ $vehicule->price_per_day }}€</td>
                        {{-- <td>{{ $vehicule->vehicule->location }}</td> --}}
                        {{-- <td>{{ $vehicule->vehicule->description }}</td> --}}
                        {{-- <td>{{ $vehicule->vehicule->capacite }}</td> --}}
                        <td>{{ $vehicule->vehicule->transmission }}</td>
                        {{-- <td>{{ $vehicule->vehicule->taille_coffre}}</td> --}}
                        {{-- <td>{{ $vehicule->vehicule->consommation_moyenne }} €</td> --}}
                        {{-- <td>{{ $vehicule->vehicule->immatricule }} €</td> --}}
                        <td>{{ $vehicule->vehicule->availability }}</td>
                        {{-- <td>{{ ucfirst($vehicule->status) }}</td> --}}
                        <td>
                            <a href="{{ route('vehicules.show', $vehicule->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('vehicules.destroy', $vehicule->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($vehicules->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">
                            <p>Aucun vehicule trouvée.</p>
                        </td>
                    </tr>

                @endif
            </tbody>
        </table>

</div>
@endsection
