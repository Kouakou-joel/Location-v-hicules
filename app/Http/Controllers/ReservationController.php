<?php

// app/Http/Controllers/ReservationController.php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Liste des réservations
    public function index()
    {
        $reservations = Reservation::with('user', 'vehicle')->get();
        return response()->json($reservations);
    }

    // Afficher le formulaire pour créer une réservation (pas nécessaire si API)
    public function create()
    {
        return view('reservations.create');
    }

    // Enregistrer une nouvelle réservation
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'total_price' => 'required|numeric',
        ]);

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $request->vehicle_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);

        return response()->json($reservation, 201);
    }

    // Afficher une réservation spécifique
    public function show($id)
    {
        $reservation = Reservation::with('user', 'vehicle')->findOrFail($id);
        return response()->json($reservation);
    }

    // Afficher le formulaire pour éditer une réservation (pas nécessaire si API)
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    // Mettre à jour une réservation
    public function update(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'total_price' => 'required|numeric',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());

        return response()->json($reservation);
    }

    // Supprimer une réservation
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json(['message' => 'Réservation supprimée avec succès.']);
    }
}

