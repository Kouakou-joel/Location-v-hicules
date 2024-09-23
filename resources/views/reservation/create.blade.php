@extends("admin.base.base")

@section('content')
<div class="container">
    <h1>Créer une nouvelle réservation</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservation.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Utilisateur</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">Sélectionnez un utilisateur</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="vehicule_id" class="form-label">Véhicule</label>
            <select name="vehicule_id" id="vehicule_id" class="form-select" required>
                <option value="">Sélectionnez un véhicule</option>
                @foreach ($vehicules as $vehicle)
                    <option value="{{ $vehicule->id }}">{{ $vehicule->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Date de début</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Date de fin</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">Prix total</label>
            <input type="number" name="total_price" id="total_price" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer la réservation</button>
        <a href="{{ route('reservation.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection