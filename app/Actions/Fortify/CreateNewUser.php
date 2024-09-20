<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     * @return \App\Models\User
     */
    public function create(array $input): User
    {
        // // Valider les données avant de créer un nouvel utilisateur
        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         Rule::unique(User::class),
        //     ],
        //     'password' => $this->passwordRules(),
        //     'pieces_identite_permis' => ['required', 'string'], // Validation pour ce champ
        //     'phone' => ['required', 'string'], // Validation pour le numéro de téléphone
        // ])->validate();

        $email = $input['email'];
        $activation_token = md5(uniqid()) . $email . sha1($email);

        // Génération du code d'activation à 5 chiffres
        $activation_code = "";
        $length_code = 5;
        for ($i = 0; $i < $length_code; $i++) {
            $activation_code .= mt_rand(0, 9);
        }
          // Créer et retourner le nouvel utilisateur
        return User::create([
            'name' => $input['name'],
            'email' =>  $email,
            'password' => Hash::make($input['password']),
            'pieces_identite_permis' => $input['pieces_identite_permis'],
            'phone' => $input['phone'],
            'activation_code ' =>$activation_code,
            'activation_token ' => $activation_token,

        ]);
    }
}
