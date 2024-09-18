<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Ajout de l'import pour DB
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
            // Journaliser l'erreur pour diagnostic
            Log::error('Erreur lors de la tentative de connexion : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue, veuillez réessayer.');
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

    /**
     * Réinitialisation du mot de passe
     */
    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validation de l'email
            $request->validate([
                'email' => 'required|email'
            ], [
                'email.required' => 'L\'email est requis.',
                'email.email' => 'Veuillez entrer une adresse email valide.'
            ]);

            // Récupération de l'email du formulaire
            $email = $request->input('email');

            // Recherche de l'utilisateur dans la base de données
            $user = DB::table('users')->where('email', $email)->first();

            // Vérification si l'utilisateur existe
            if ($user) {
                 $full_name = $user->name;
                 $activation_token = md5(uniqid()) . $email . sha1($email);
                // Logique d'envoi de l'email de réinitialisation ici
                // Par exemple : envoyer un lien de réinitialisation de mot de passe
                return redirect()->back()->with('success', 'Un email de réinitialisation a été envoyé.');
            } else {
                return redirect()->back()->withErrors(['email' => 'Aucun utilisateur avec cet email n\'a été trouvé.']);
            }
        }

        return view("auth.forgot-password");
    }
}
