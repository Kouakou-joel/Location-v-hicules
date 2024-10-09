@extends("admin.base.base")

@section('content-admin')
<div class="container">
    <h1>Modifier l'utilisateur</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<!-- resources/views/users/edit.blade.php -->

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Nom :</label>
    <input type="text" name="name" id="name" value="{{ $user->name }}" required>

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" value="{{ $user->email }}" required>

    <label for="role">Rôle :</label>
    <select name="role" id="role">
        <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client</option>
        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
    </select>

    <button type="submit">Mettre à jour</button>
</form>


@endsection
