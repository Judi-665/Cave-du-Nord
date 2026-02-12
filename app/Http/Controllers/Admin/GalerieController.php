<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalerieController extends Controller
{
    // Afficher la page de gestion de la galerie
    public function index()
    {
        $galeries = Galerie::orderBy('created_at', 'desc')->get();
        return view('admin.galeries.galerie-form', compact('galeries'));
    }

    // Enregistrer une nouvelle image
    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'legende' => 'nullable|string|max:255'
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('galeries', 'public');
            }

            $galerie = Galerie::create([
                'image' => $imagePath,
                'legende' => $request->legende
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Image ajoutée avec succès',
                'galerie' => $galerie
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    // Récupérer les données d'une image pour modification
    public function edit($id)
    {
        $galerie = Galerie::findOrFail($id);
        return response()->json($galerie);
    }

    // Mettre à jour une image
    public function update(Request $request, $id)
    {
        try {
            $galerie = Galerie::findOrFail($id);

            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'legende' => 'nullable|string|max:255'
            ]);

            // Mise à jour de l'image si fournie
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image
                if ($galerie->image) {
                    Storage::disk('public')->delete($galerie->image);
                }
                
                $imagePath = $request->file('image')->store('galeries', 'public');
                $galerie->image = $imagePath;
            }

            $galerie->legende = $request->legende;
            $galerie->save();

            return response()->json([
                'success' => true,
                'message' => 'Image modifiée avec succès',
                'galerie' => $galerie
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    // Supprimer une image
    public function destroy($id)
    {
        try {
            $galerie = Galerie::findOrFail($id);
            
            // Supprimer l'image
            if ($galerie->image) {
                Storage::disk('public')->delete($galerie->image);
            }
            
            $galerie->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image supprimée avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }
}