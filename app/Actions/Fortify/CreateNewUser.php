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
    public function create(array $input)
    {
        // Valider les données avant de créer un nouvel utilisateur
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'pieces_identite_permis' => ['required', 'string'], // Validation pour ce champ
            'phone' => ['required', 'string'], // Validation pour le numéro de téléphone
        ])->validate();

        // Créer et retourner le nouvel utilisateur
        // return User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password']),
        //     'pieces_identite_permis' => $input['pieces_identite_permis'], // Correction de l'espace en trop
        //     'phone' => $input['phone'],
        // ]);

        return [];
    }
}
