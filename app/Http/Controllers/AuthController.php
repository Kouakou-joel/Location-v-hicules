<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view("auth.login");
    }

    public function postLogin(Request $request)
{
    try {
        // Validation des données du formulaire
        $request->validate([
            'email' => 'required|string|email|max:191',
            'password' => 'required|string|min:4',
        ], [
            'email.required' => 'Le mail est requis',
            'password.required' => 'Le mot de passe est requis.',
        ]);

        // Récupération des informations du formulaire
        $credentials = $request->only('email', 'password');
        $pw1 =  bcrypt("1234");
        $pw2 =  Hash::make("1234");
        dd(vars: $pw2);
        // Authentification de l'utilisateur via la façade Auth
        if (Auth::attempt($credentials)) {
            // Si l'authentification réussit, rediriger vers le tableau de bord
            return redirect()->route('home-admin')->with('success', 'Connexion réussie !');
        } else {
            // Sinon, retour à la page de connexion avec un message d'erreur
            return redirect()->back()->with(['error' => 'Oops, connexion impossible email ou mot de pas incorrect !']);
        }

    } catch (\Exception $e) {
        // Gérer l'exception et retourner un message d'erreur
     
        return redirect()->back()->with('error', 'Une erreur est survenue, veuillez réessayer.');
    }
}



    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        return view("auth.register");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout(){

    }
}

