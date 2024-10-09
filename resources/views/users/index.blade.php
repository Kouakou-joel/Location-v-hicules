@extends("admin.base.base")

@section('content-admin')
<div class="container">
    <h1 class="my-4">Liste des utilisateurs</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="mb-4">
    <a href="{{ route('users.create') }} " class="btn btn-primary">Créer un nouvel utilisateur</a>

</div>
@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<table class="table table-bordered ">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?') ">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


    @endsection
