<?php

namespace App\Http\Controllers\Admin;  // Namespace corrigé

use App\Http\Controllers\Controller;
use App\Models\Vin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VinController extends Controller
{
    // Afficher la page de gestion des vins
    public function index()
    {
        $vins = Vin::orderBy('created_at', 'desc')->get();
        return view('admin.vins.vin-form', compact('vins'));
    }

    // Enregistrer un nouveau vin
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vins', 'public');
        }

        $vin = Vin::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'description' => $request->description,
            'image' => $imagePath
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Vin ajouté avec succès',
            'vin' => $vin
        ]);
    }

    // Récupérer les données d'un vin pour modification
    public function edit($id)
    {
        $vin = Vin::findOrFail($id);
        return response()->json($vin);
    }

    // Mettre à jour un vin
    public function update(Request $request, $id)
    {
        $vin = Vin::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Mise à jour de l'image si fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($vin->image) {
                Storage::disk('public')->delete($vin->image);
            }
            
            $imagePath = $request->file('image')->store('vins', 'public');
            $vin->image = $imagePath;
        }

        $vin->nom = $request->nom;
        $vin->prix = $request->prix;
        $vin->description = $request->description;
        $vin->save();

        return response()->json([
            'success' => true,
            'message' => 'Vin modifié avec succès',
            'vin' => $vin
        ]);
    }

    // Supprimer un vin
    public function destroy($id)
    {
        $vin = Vin::findOrFail($id);
        
        // Supprimer l'image
        if ($vin->image) {
            Storage::disk('public')->delete($vin->image);
        }
        
        $vin->delete();

        return response()->json([
            'success' => true,
            'message' => 'Vin supprimé avec succès'
        ]);
    }
}