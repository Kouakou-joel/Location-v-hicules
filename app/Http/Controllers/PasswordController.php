<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    // Afficher le formulaire de changement de mot de passe
    public function edit()
    {
        return view('auth.passwords-change');
    }

    // Mise à jour du mot de passe
    public function update(Request $request)
    {
        // Valider les champs
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:4|confirmed',
        ], [
            'password.min' => 'Le nouveau mot de passe doit contenir au moins 4 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        // Vérifier que le mot de passe actuel est correct
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        // Mettre à jour le mot de passe
        $user = Auth::user();

        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('passwords.change')->with('success', 'Mot de passe mis à jour avec succès.');
    }
}
