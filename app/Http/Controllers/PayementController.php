<?php

namespace App\Http\Controllers;

use App\Models\Payement;
use App\Models\User;
use Illuminate\Http\Request;

class PayementController extends Controller
{
    //
    public function index(){

        $payements = Payement::with('user')->get();

        return view('admin.pages.payements.index', compact('payements'));
    }

    public function create(){
        $users =  User::all();
        return view('admin.pages.payements.create', compact('users'));
    }

    public function store(Request $request)
      {

      $request ->validate([
        'reservation_id' => 'required|exists:reservation,id',
        'transaction_id' => 'required|exists:transaction,id',
        'amount' => 'required|numeric:',
        'payement_methode' => 'required|string:',
        'payement_status' => 'required|string:',
        'date' => 'required|date:',
        ]);
        Payement::create($request->all());
        return redirect()->route('payements.index')->with('succes','paiement enregistré avec success.' );
    }

    public function edit(payement $payement)
    {
        $users =  User::all();
        return view('admin.pages.payements.edit', compact('Payement', 'users'));

    }
    public function update(Request $request, Payement $Payement)
    {

        $request ->validate([
            'reservation_id' => 'required|exists:reservation,id',
            'transaction_id' => 'required|exists:transaction,id',
            'amount' => 'required|numeric:',
            'payement_methode' => 'required|string:',
            'payement_status' => 'required|string:',
            'date' => 'required|string:',
            ]);
            Payement::create($request->all());

      return redirect()->route('Payement.index')->with('success', 'Payement mis à jour avec succès.' );
    }
    public function destroy(Payement $payement)
    {
        $payement->delete();
        return redirect()->route('payements.index')->with('success','payement supprimé avec success.') ;
    }
}
