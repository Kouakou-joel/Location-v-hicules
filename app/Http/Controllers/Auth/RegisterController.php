<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:4',
            'pieces_identite_permis' => 'required|string',
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/',
        ], [
            'name.required' => 'Le nom est requis.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'phone.regex' => 'Le numéro de téléphone doit être valide.',
        ]);
    
        try {
            // Création de l'utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),  // Utilisation de Hash::make()
                'pieces_identite_permis' => $request->pieces_identite_permis,
                'phone' => $request->phone,
            ]);
    
            if ($user) {
                return redirect()->route('login')->with('success', 'Inscription réussie !');
            } else {
                return redirect()->back()->with('error', 'Oops, inscription impossible !');
            }
        } catch (\Exception $e) {
            // Redirection avec un message d'erreur
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'inscription : ' . $e->getMessage());
        }
    }
    
}
