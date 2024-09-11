<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Afficher la liste des utilisateurs
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     // Enregistrer un nouvel utilisateur
     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:191|unique:users',
             'password' => 'required|string|min:8|confirmed',
             'pieces_identite_permis' => 'required|string',
             'phone' => 'required|string',
         ]);
 
         User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
             'pieces_identite_permis' => $request->pieces_identite_permis,
             'phone' => $request->phone,
         ]);
 
         return redirect()->route('users.index')->with('success', 'User created successfully.');
     }

    /**
     * Display the specified resource.
     */
    // Afficher un utilisateur spécifique
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    // Afficher le formulaire d'édition
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Mettre à jour les informations de l'utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'pieces_identite_permis' => 'required|string',
            'phone' => 'required|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'pieces_identite_permis' => $request->pieces_identite_permis,
            'phone' => $request->phone,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    // Supprimer un utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
