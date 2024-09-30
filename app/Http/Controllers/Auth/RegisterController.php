<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Pour enregistrer les erreurs dans le log

class RegisterController extends Controller
{
    /**
     * Enregistrer un nouvel utilisateur et envoyer un email d'activation.
     */
    public function register(Request $request)
    {
        // Validation des données du formulaire avec des messages d'erreur personnalisés
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:4|',
            'pieces_identite_permis' => 'required|string',
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/',
        ], [
            'name.required' => 'Le nom est requis.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'phone.regex' => 'Le numéro de téléphone doit être valide et contenir entre 10 et 15 chiffres.',
        ]);

        // Génération d'un token et d'un code d'activation
        $activation_token = bin2hex(random_bytes(30));
        $activation_code = sprintf('%05d', mt_rand(0, 99999));

        // Envoi de l'email d'activation
        // try {
        //     $emailService = new EmailService();
        //     $subject = config('mail.activation_subject', 'Activate your account');
        //     $message = "Bonjour " . $request->name . ",\n\nVeuillez activer votre compte. Copiez votre code d'activation : " . $activation_code .
        //         "\n\nOu cliquez sur le lien suivant pour activer votre compte : " . url('/activate?token=' . $activation_token);

        //     $emailService->sendEmail($subject, $request->email, $request->name, false, $message);
        // } catch (\Exception $e) {
        //     Log::error('Échec de l\'envoi de l\'email d\'activation : ' . $e->getMessage());
        //     return redirect()->back()->withErrors('Échec de l\'envoi de l\'email d\'activation. Veuillez réessayer.');
        // }

        // Création de l'utilisateur
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'pieces_identite_permis' => $request->pieces_identite_permis,
                'phone' => $request->phone,
                'activation_token' => $activation_token,
                'activation_code' => $activation_code,
            ]);

            return redirect()->route('login')->with('success', 'Inscription réussie ! Veuillez vérifier votre email pour activer votre compte.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'utilisateur : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.');
        }
    }

    /**
     * Vérifier si l'email existe déjà dans la base de données.
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
}
