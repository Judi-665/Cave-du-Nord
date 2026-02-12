<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Vin;
use App\Models\Menu;
use App\Models\Galerie;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les derniers éléments pour l'aperçu sur la page d'accueil
        $vins = Vin::orderBy('created_at', 'desc')->take(6)->get();
        $menus = Menu::orderBy('created_at', 'desc')->take(6)->get();
        $galeries = Galerie::orderBy('created_at', 'desc')->take(8)->get();
        
        // Statistiques
        $totalVins = Vin::count();
        $totalMenus = Menu::count();
        $totalGaleries = Galerie::count();

        return view('site.home.index', compact('vins', 'menus', 'galeries', 'totalVins', 'totalMenus', 'totalGaleries'));
    }
}