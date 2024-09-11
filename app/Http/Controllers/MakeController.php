<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Make;
class MakeController extends Controller
{
    //

    public function index()
    {
        $makes = Make::all();
        return view("admin.pages.makes.index", compact('makes')); // Cette vue gérera tout
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gérer le téléchargement du fichier logo
        if ($request->hasFile('logo')) {
            $logoName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('logos'), $logoName);
        }

        Make::create([
            'name' => $request->name,
            'logo' => $logoName,
        ]);

        return redirect()->route('makes.index')->with('success', 'La marque a bien été créer avec succès.');
    }

    public function edit(Make $make)
    {
        $makes = Make::all();
        return view('admin.pages.makes.index', compact('makes', 'make')); // On utilise la même vue
    }


    public function update(Request $request, Make $make)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gérer l'upload du nouveau logo, s'il existe
        if ($request->hasFile('logo')) {
            $logoName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('logos'), $logoName);

            // Supprimer l'ancien logo si nécessaire
            if (file_exists(public_path('logos/'.$make->logo))) {
                unlink(public_path('logos/'.$make->logo));
            }

            $make->logo = $logoName;
        }

        $make->name = $request->name;
        $make->save();

        return redirect()->route('makes.index')->with('success', 'Make updated successfully.');
    }


    public function destroy(Make $make)
    {
        $make->delete();

        return redirect()->route('makes.index')->with('success', 'La marque a bien été supprimer.');
    }


}
