<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création d'un nouvel utilisateur.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function register(Request $request)
    {
        // Validation des données avec des messages d'erreur personnalisés
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:4',
            'pieces_identite_permis' => 'required|string',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',
        ], [
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.min' => 'Le mot de passe doit contenir au moins 4 caractères.',
            'phone.regex' => 'Le numéro de téléphone doit contenir 10 chiffres.',
        ]);

        // Génération d'un token et d'un code d'activation
        $activation_token = $this->genererTokenActivation();
        $activation_code = $this->genererCodeActivation();

        // Création de l'utilisateur avec hachage du mot de passe
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pieces_identite_permis' => $request->pieces_identite_permis,
            'phone' => $request->phone,
            'activation_token' => $activation_token,
            'activation_code' => $activation_code,
        ]);

        // Envoi de l'email d'activation
        try {
            $emailService = new EmailService();
            $subject = config('mail.activation_subject', 'Activez votre compte');
            $message = "Bonjour " . $request->name . ",\n\nVeuillez activer votre compte. Copiez votre code d'activation : " . $activation_code .
                "\n\nOu cliquez sur le lien suivant pour activer votre compte : " . url('/activate?token=' . $activation_token);

            $emailService->sendEmail($subject, $request->email, $request->name, false, $message);
        } catch (\Exception $e) {
            Log::error("Échec de l'envoi de l'email d'activation : " . $e->getMessage());
            return redirect()->back()->withErrors('Échec de l\'envoi de l\'email d\'activation. Veuillez réessayer.');
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur enregistré avec succès. Un email d\'activation a été envoyé.');
    }

    /**
     * Génère un token d'activation.
     */
    private function genererTokenActivation()
    {
        return bin2hex(random_bytes(30));
    }

    /**
     * Génère un code d'activation.
     */
    private function genererCodeActivation()
    {
        return sprintf('%05d', mt_rand(0, 99999));
    }

    /**
     * Affiche les détails d'un utilisateur.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Affiche le formulaire d'édition d'un utilisateur.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Met à jour un utilisateur existant.
     */
    public function update(Request $request, User $user)
    {
        // Validation des données avec des messages d'erreur personnalisés
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'pieces_identite_permis' => 'required|string',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',
        ], [
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.regex' => 'Le numéro de téléphone doit contenir 10 chiffres.',
        ]);

        // Mise à jour des informations de l'utilisateur
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'pieces_identite_permis' => $request->pieces_identite_permis,
            'phone' => $request->phone,
        ]);

        // Mise à jour du mot de passe si fourni
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
