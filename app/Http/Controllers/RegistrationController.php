<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;

// class RegistrationController extends Controller
// {
//     public function store(Request $request)
//     {
//         // Validation des données
//         $validator = Validator::make($request->all(), [
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users',
//             'password' => 'required|string|min:8|confirmed',
//             'pieces' => 'required|string',
//             'telephone' => 'required|string',
//             'agreeterms' => 'accepted',
//         ]);

//         if ($validator->fails()) {
//             return redirect()->back()->withErrors($validator)->withInput();
//         }

//         // Création de l'utilisateur
//         User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'pieces' => $request->pieces,
//             'telephone' => $request->telephone,
//         ]);

//         // Redirection ou message de succès
//         return redirect()->route('home')->with('success', 'Inscription réussie !');
//     }
// }
