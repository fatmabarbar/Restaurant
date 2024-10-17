<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::all();
        return response()->json($commandes, 200);
    }

    public function show($id)
    {
        $commande = Commande::find($id);

        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        return response()->json($commande, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required',
            'date' => 'required|date',
            'total' => 'required|numeric',
            'status' => 'required',
            'user_id' => 'required|exists:users,id',
            // Ajoutez d'autres validations si nécessaire
        ]);

        $commande = Commande::create($request->all());

        return response()->json($commande, 201);
    }

    public function update(Request $request, $id)
    {
        $commande = Commande::find($id);

        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        $request->validate([
            'numero' => 'required',
            'date' => 'required|date',
            'total' => 'required|numeric',
            'status' => 'required',
            'user_id' => 'required|exists:users,id',
            // Ajoutez d'autres validations si nécessaire
        ]);

        $commande->update($request->all());

        return response()->json($commande, 200);
    }

    public function destroy($id)
    {
        $commande = Commande::find($id);

        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        $commande->delete();

        return response()->json(['message' => 'Commande supprimée avec succès'], 200);
    }
}
