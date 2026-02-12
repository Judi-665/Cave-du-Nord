<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // Afficher la page de gestion des menus
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'desc')->get();
        return view('admin.menus.menu-form', compact('menus'));
    }

    // Enregistrer un nouveau menu
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'prix' => 'required|numeric|min:0',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('menus', 'public');
            }

            $menu = Menu::create([
                'nom' => $request->nom,
                'type' => $request->type,
                'prix' => $request->prix,
                'description' => $request->description,
                'image' => $imagePath
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Menu ajouté avec succès',
                'menu' => $menu
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

    // Récupérer les données d'un menu pour modification
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }

    // Mettre à jour un menu
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Mise à jour de l'image si fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            
            $imagePath = $request->file('image')->store('menus', 'public');
            $menu->image = $imagePath;
        }

        $menu->nom = $request->nom;
        $menu->type = $request->type;
        $menu->prix = $request->prix;
        $menu->description = $request->description;
        $menu->save();

        return response()->json([
            'success' => true,
            'message' => 'Menu modifié avec succès',
            'menu' => $menu
        ]);
    }

    // Supprimer un menu
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        // Supprimer l'image
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }
        
        $menu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu supprimé avec succès'
        ]);
    }
}