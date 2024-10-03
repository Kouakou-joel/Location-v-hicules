@extends("admin.base.base")

@section('content-admin')
<div class="container">
    <h1 class="my-4">Liste des paiements</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-3">
        <a href="{{ route('payements.create') }}" class="btn btn-primary">Ajouter un paiement</a>
    </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID de transaction</th>
                    <th>ID de reservation</th>
                    <th>Montant</th>
                    <th>Methode de paiement</th>
                    <th>Date de paiement</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payements as $payement)
                    <tr>
                        <td>{{ $payement->id }}</td>
                        <td>{{ $paiement->payement->reservaion_id }}</td>
                        <td>{{ $payement->payement->transaction_id }}</td>
                        <td>{{ $payement->amount }}Fcfa</td>
                        <td>{{ $payement->payement->payement_methode }}</td>
                        <td>{{ $payement->date }}</td>
                        <td>{{ ucfirst($payement->payement_status) }}</td>
                        <td>
                            <a href="{{ route('payements.edit', $payement->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('payements.destroy', $payement->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet payement ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($payements->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">
                            <p>Aucun paiement trouvée.</p>
                        </td>
                    </tr>

                @endif
            </tbody>
        </table>

</div>
@endsection

