<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return response()->json($produits, 200);
    }

    public function show($id)
    {
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        return response()->json($produit, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable'
            // Ajoutez ici les validations pour les autres champs
        ]);

        $produit = Produit::create($request->all());

        return response()->json($produit, 201);
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable'
            // Ajoutez ici les validations pour les autres champs
        ]);

        $produit->update($request->all());

        return response()->json($produit, 200);
    }

    public function destroy($id)
    {
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        $produit->delete();

        return response()->json(['message' => 'Produit supprimé avec succès'], 200);
    }
}
