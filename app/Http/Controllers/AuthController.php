<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Affiche la page de connexion.
     */
    public function login()
    {
        // Vérifie si l'utilisateur est déjà connecté
        if (Auth::check()) {
            return redirect()->route('home-admin')->with('success', 'Vous êtes déjà connecté.');
        }
        return view('auth.login');
    }
    /**
     * Gestion de la tentative de connexion.
     */
    public function postLogin(Request $request)
    {
        try {
            // Validation des données du formulaire
            $request->validate([
                'email' => 'required|string|email|max:191',
                'password' => 'required|string|min:4',
            ], [
                'email.required' => 'Le mail est requis.',
                'email.email' => 'Veuillez entrer une adresse email valide.',
                'password.required' => 'Le mot de passe est requis.',
                'password.min' => 'Le mot de passe doit contenir au moins 4 caractères.',
            ]);


            // Récupération des informations du formulaire
            $credentials = $request->only('email', 'password');

            // Tentative d'authentification
            if (Auth::attempt($credentials)) {
                // Authentification réussie, rediriger vers le tableau de bord
                return redirect()->route('home-admin')->with('success', 'Connexion réussie !');
            } else {
                // Si l'authentification échoue
                return redirect()->back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
            }
        }
        catch (\Exception $e) {
            // // Journaliser l'erreur
            // Log::error('Erreur lors de la tentative de connexion : ' . $e->getMessage());
            // return redirect()->back()->with('error', 'Une erreur est survenue, veuillez réessayer.');
        }
    }

    /**
     * Affiche la page d'inscription.
     */
    public function register()
    {
        return view("auth.register");
    }

    /**
     * Déconnexion de l'utilisateur.
     */
    public function logout()
    {
        // Vérifie si l'utilisateur est connecté avant de déconnecter
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('login')->with('success', 'Vous avez été déconnecté avec succès.');
        }

        return redirect()->route('login')->with('info', 'Vous n\'étiez pas connecté.');
    }

    public function forgotPassword(){

        return view("auth.forgot-password");
    }
}
