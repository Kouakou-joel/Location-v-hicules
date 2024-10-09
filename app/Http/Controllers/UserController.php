<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $validated = $this->validateUser($request);

        // Création de l'utilisateur
        $user = $this->createUser($validated);

        // Envoi de l'email d'activation
        $this->sendActivationEmail($user);

        return redirect()->route('users.index')->with('success', 'Utilisateur enregistré avec succès. Un email d\'activation a été envoyé.');
    }

    /**
     * Affiche le formulaire d'édition d'un utilisateur.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Met à jour un utilisateur.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update($validated);

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

    /**
     * Valide les données de l'utilisateur.
     */
    private function validateUser(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:4',
            'role_id' => 'required|exists:roles,id',
            'pieces_identite_permis' => 'required|string',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',
        ], [
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.min' => 'Le mot de passe doit contenir au moins 4 caractères.',
            'phone.regex' => 'Le numéro de téléphone doit contenir 10 chiffres.',
        ]);
    }

    /**
     * Crée un nouvel utilisateur.
     */
    private function createUser(array $validated)
    {
        $activation_token = $this->generateActivationToken();
        $activation_code = $this->generateActivationCode();

        return User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'pieces_identite_permis' => $validated['pieces_identite_permis'],
            'phone' => $validated['phone'],
            'activation_token' => $activation_token,
            'activation_code' => $activation_code,
        ]);
    }

    /**
     * Envoie un email d'activation.
     */
    private function sendActivationEmail(User $user)
    {
        try {
            $emailService = new EmailService();
            $subject = config('mail.activation_subject', 'Activez votre compte');
            $message = "Bonjour {$user->name},\n\nVeuillez activer votre compte avec ce code: {$user->activation_code}" .
                "\n\nOu cliquez ici: " . url('/activate?token=' . $user->activation_token);

            $emailService->sendEmail($subject, $user->email, $user->name, false, $message);
        } catch (\Exception $e) {
            Log::error("Échec de l'envoi de l'email d'activation : " . $e->getMessage());
        }
    }

    /**
     * Génère un token d'activation.
     */
    private function generateActivationToken()
    {
        return bin2hex(random_bytes(30));
    }

    /**
     * Génère un code d'activation.
     */
    private function generateActivationCode()
    {
        return sprintf('%05d', mt_rand(0, 99999));
    }
}
