<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $categorie = Categorie::create([
            'nomcategorie' => $request->input('nomcategorie'),
            'description' => $request->input('description'),
        ]);

        return response()->json($categorie, 201);
    }

    public function show($id)
    {
        $categorie = Categorie::findOrFail($id);
        return response()->json($categorie);
    }

    public function update(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->update($request->all());

        return response()->json($categorie, 200);
    }

    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return response()->json('Catégorie supprimée !');
    }
}
