<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\Request;
class VehiculeController extends Controller
{
    //afficher la liste des vehicules
    public function index(){

        $vehicules =  Vehicule::all();
        return view('admin.pages.vehicules.index', compact('vehicules'));
    }
    // Afficher les formulaire de creation
    public function create(){
        $users =  User::all();
        return view('admin.pages.vehicules.create');
    }
   // Enregistrer un nouveau vehicule
   public function store(Request $request)
      {

      $request ->validate([
        'user_id' => 'required|exists:user,id',
        'make_id' => 'required|exists:vehicles,id',
        'type_vehicule_id' => 'required|exists:vehicles,id',
        'year' => 'required|integer:',
        'price_per_day' => 'required|numeric:',
        'location' => 'required|exists:',
        'yavailability' => 'required|exists:',
        'description' => 'required|exists:',
        'images' => 'required|exists:',
        'capacite' => 'required|exists:',
        'transmission' => 'required|exists:',
        'taille_coffre' => 'required|exists:',
        'consommation_moyenne' => 'required|exists:',
        'immatricule' => 'required|unique:vehicules',
        ]);

        $vehicule = Vehicule::create($request->all());

        return redirect()->route('vehicules.index')->with('success', 'Vehicule ajouté avec succès.' );

  }

    // Afficher un vehicule specifique
    public function show(Vehicule $vehicule)
    {

        return view('admin.pages.vehicules.show', compact('vehicule'));

    }
    // afficher le formulaire d edition
    public function edit(Vehicule $vehicule)
    {

        return view('admin.pages.vehicules.edit', compact('vehicule'));

    }
    // mettre a jour un vehicules
    public function update(Request $request, Vehicule $vehicule)
    {

    $request ->validate([

      'user_id' => 'required|exists:user,id',
      'make_id' => 'required|exists:vehicles,id',
      'type_vehicule_id' => 'required|exists:vehicles,id',
      'year' => 'required',
      'price_per_day' => 'required|numeric:',
      'location' => 'required|exists:',
      'yavailability' => 'required|exists:',
      'description' => 'required|exists:',
      'images' => 'required|exists:',
      'capacite' => 'required|exists:',
      'transmission' => 'required|exists:',
      'taille_coffre' => 'required|exists:',
      'consommation_moyenne' => 'required|exists:',
      'immatricule' => 'required|unique:vehicules',
         ]);

       Vehicule::create($request->all());

      return redirect()->route('vehicules.index')->with('success', 'Vehicule mis à jour avec succès.' );
    }
    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();

        return redirect()->route('vehicules.index')->with('success', 'Vehicule supprimé avec succès.' );

    }
}
