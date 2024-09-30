@extends("admin.base.base")

@section('content-admin')
<div class="container">
    <h1>Ajouter un nouveau Vehicule</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehicules.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Utilisateur</label>
            <select name="user_id" id="user_id" class="form-select" required>

                @if (isset($users) && count ($users) >0)

                    <option value="">Sélectionnez un utilisateur</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach

                @endif

            </select>
        </div>

        <div class="mb-3">
            <label for="make_id" class="form-label">Marque</label>
            <select name="make_id" id="make_id" class="form-select" required>
                @if (isset($makes) && count ($makes) >0)

                <option value="">Sélectionnez un marque</option>
                @foreach ($makes as $make)
                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                @endforeach

                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="modele_id" class="form-label">Modèle</label>
            <select name="modele_id" id="modele_id" class="form-select" required>
                <option value="">Sélectionnez un modele</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="type_vehicule_id" class="form-label">Type de vehicule</label>
            <select name="type_vehicule_id" id="type_vehicule_id" class="form-select" required>
                @if (isset($vehicules) && count ($vehicules) >0)

                <option value="">Sélectionnez le type de véhicule</option>
                @foreach ($vehicules as $vehicule)
                    <option value="{{ $vehicule->id }}">{{ $vehicule->name }}</option>
                @endforeach

                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Année</label>
            <input type="date" name="year" id="year" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price_per_day" class="form-label">Prix par jour</label>
            <input type="number" name="price_per_day" id="price_per_day" class="form-control" step="1" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control"  required>
        </div>
        <div class="mb-3">
            <label for="availability" class="form-label">Disponibility</label>
            <input type="text" name="availability" id="availability" class="form-control"  required>
        </div>

        <div class="mb-3">
            <label for="dscription" class="form-label">Description</label>
            <textarea name="dscription" id="dscription" cols="30" rows="10" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Image</label>
            <input type="file" name="images" id="images" class="form-control"  required>

            @if(isset($vehicule) && $vehicule->images)
            <img src="{{ asset('images/' . $vehicule->images) }}" alt="{{ $vehicule->name }}" width="100" class="mt-2">
        @endif
        </div>

        <div class="mb-3">
            <label for="capacite" class="form-label">Capacité</label>
            <input type="text" name="capacite" id="capacite" class="form-control"  required>
        </div>

        <div class="mb-3">
            <label for="transmission" class="form-label">Transmission</label>
            <input type="text" name="transmission" id="transmission" class="form-control"  required>
        </div>
        <div class="mb-3">
            <label for="taille_coffre" class="form-label">Taille_coffre</label>
            <input type="text" name="taille_coffre" id="taille_coffre" class="form-control"  required>
        </div>
        <div class="mb-3">
            <label for="consommation_moyenne" class="form-label">consommation_moyenne</label>
            <input type="text" name="consommation_moyenne" id="consommation_moyenne" class="form-control"  required>
        </div>
        <div class="mb-3">
            <label for="immatricule" class="form-label">immatricule</label>
            <input type="text" name="immatricule" id="immatricule" class="form-control"  required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="{{ route('vehicules.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
