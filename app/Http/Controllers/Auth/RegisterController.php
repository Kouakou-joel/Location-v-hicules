<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\EmailService;
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

        // Génération d'un token d'activation aléatoire de 60 caractères
        $activation_token = bin2hex(random_bytes(30));

        // Génération du code d'activation à 5 chiffres
        $activation_code = sprintf('%05d', mt_rand(0, 99999));

        // Envoi de l'email d'activation avec gestion des erreurs
        try {
            $emailSend = new EmailService();
            $subject = config('mail.activation_subject', 'Activate your account');
            $message = "Hi " . $request->name . ",\n\nPlease activate your account. Copy your activation code: " . $activation_code .
                       "\n\nOr click the following link to activate your account: " . url('/activate?token=' . $activation_token);

            $emailSend->sendEmail($subject, $request->email, $request->name, false, $message);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Échec de l\'envoi de l\'email d\'activation. Veuillez réessayer.');
        }

        // Création de l'utilisateur
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'pieces_identite_permis' => $request->pieces_identite_permis,
                'phone' => $request->phone,
                'activation_token' => $activation_token,
                'activation_code' => $activation_code,
            ]);

            return redirect()->route('login')->with('success', 'Inscription réussie !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'inscription : ' . $e->getMessage());
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
