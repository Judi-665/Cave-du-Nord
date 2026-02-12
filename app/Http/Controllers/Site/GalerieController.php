<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Galerie;

class GalerieController extends Controller
{
    public function index()
    {
        // Récupérer TOUTES les images de la galerie
        $galeries = Galerie::orderBy('created_at', 'desc')->get();
        
        return view('site.galerie.index', compact('galeries'));
    }
}