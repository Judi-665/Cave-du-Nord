<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Vin;

class VinController extends Controller
{
    public function index()
    {
        // Récupérer TOUS les vins ajoutés par l'admin
        $vins = Vin::orderBy('created_at', 'desc')->get();
        
        return view('site.vins.index', compact('vins'));
    }
}