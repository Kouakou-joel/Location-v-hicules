@extends("admin.base.base")

@section('content-admin')
<div class="container mb-4">
    <h1>Ajouter un nouveau payement</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('payements.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="reservation_id" class="form-label">Identifiant du reservation</label>
                    <select name="reservation_id" id="reservation_id" class="form-select" required>

                            @if (isset($payements) && count ($payements) >0)

                            <option value="">Sélectionnez un Identifiant du reservation</option>
                            @foreach ($payements as $payements)
                                <option value="{{ $payement->id }}">{{ $payement->name }}</option>
                            @endforeach

                            @endif
                    </select>
        </div>



        <div class="mb-3">
            <label for="transaction_id" class="form-label">Identifiant du transaction</label>
            <input type="text" name="transaction_id" id="transaction_id" class="form-control"  required>

        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Montant</label>
            <input type="number" name="amount" id="amount" class="form-control"  required>
        </div>


        <div class="mb-3">
            <label for="payement_methode" class="form-label">Montant de payement</label>
            <input type="payement_methode" name="payement_methode" id="payement_methode" class="form-control" step="1" required>
        </div>

        <div class="mb-3">
            <label for="payement_status" class="form-label">status</label>
            <input type="number" name="payement_status" id="payement_status" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date de payement</label>
            <input type="date" name="date" id="date" class="form-control"  required>
        </div>


        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('payements.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
