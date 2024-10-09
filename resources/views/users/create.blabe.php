@extends("admin.base.base")

@section('content-admin')
<div class="container mt-5">
    <h1>Créer un nouvel utilisateur</h1>

    <!-- Affichage des messages d'erreur -->
    @if ($errors->any())

        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire de création d'utilisateur -->
    <form action="{{ route('users.store') }}" method="POST" class="mt-4">
        @csrf

        <!-- Nom -->
        <div class="form-group mb-3">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <!-- Mot de passe -->
        <div class="form-group mb-3">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <!-- Rôle -->
        <div class="form-group mb-4">
            <label for="role">Rôle :</label>
            <select name="role" id="role" class="form-select" required>
                <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
