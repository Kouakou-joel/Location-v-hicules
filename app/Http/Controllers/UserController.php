<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Pour la génération du token d'activation

class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Vérifier si un email existe déjà dans la base de données.
     */
    public function checkEmail(Request $request)
    {
        $emailExists = User::where('email', $request->email)->exists();
        return response()->json(['response' => $emailExists ? 'exist' : 'not-exist']);
    }

    /**
     * Vérifier si les pièces d'identité existent déjà dans la base de données.
     */
    public function checkPieces(Request $request)
    {
        $piecesExists = User::where('pieces_identite_permis', $request->pieces)->exists();
        return response()->json(['response' => $piecesExists ? 'exist' : 'not-exist']);
    }

    /**
     * Afficher le formulaire de création d'un nouvel utilisateur.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function register(Request $request)
    {
        // Validation des données entrantes avec messages d'erreur personnalisés
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


        // Génération d'un token d'activation unique
        $email = $request->email;
        // Génération d'un token d'activation aléatoire de 60 caractères

        $activation_token = bin2hex(random_bytes(30));
        // Génération du code d'activation à 5 chiffres
        $activation_code = sprintf('%05d', mt_rand(0, 99999));

        // Création de l'utilisateur dans la base de données
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pieces_identite_permis' => $request->pieces_identite_permis,
            'phone' => $request->phone,
            'activation_token' => $activation_token,
            'activation_code' => $activation_code,
        ]);

        //Envoi de l'email d'activation avec gestion des erreurs
        try {
            $emailSend = new EmailService();
            $subject = config('mail.activation_subject', 'Activate your account');
            $message = "Hi " . $request->name . ", please activate your account. Copy your activation code: " . $activation_code .
                       " or click the link below to activate your account: " . $activation_token;
            $emailSend->sendEmail($subject, $email, $request->name, false, $message);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Échec de l\'envoi de l\'email d\'activation. Veuillez réessayer.');
        }

        // Redirection avec un message de succès
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Afficher les détails d'un utilisateur.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Afficher le formulaire d'édition d'un utilisateur.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Mettre à jour un utilisateur existant.
     */
    public function update(Request $request, User $user)
    {
        // Validation des données avec messages personnalisés
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'pieces_identite_permis' => 'required|string',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',
        ], [
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.regex' => 'Le numéro de téléphone doit contenir 10 chiffres.',
        ]);

        // Mise à jour de l'utilisateur
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'pieces_identite_permis' => $request->pieces_identite_permis,
            'phone' => $request->phone,
        ]);

        // Mise à jour du mot de passe si présent
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprimer un utilisateur.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
