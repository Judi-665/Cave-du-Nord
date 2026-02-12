<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vin;
use App\Models\Menu;
use App\Models\Galerie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer toutes les données pour les sections
        $vins = Vin::orderBy('created_at', 'desc')->get();
        $menus = Menu::orderBy('created_at', 'desc')->get();
        $galeries = Galerie::orderBy('created_at', 'desc')->get();
        
        $section = $request->query('section', 'vins');

        return view('admin.dashboard', compact('section', 'vins', 'menus', 'galeries'));
    }
}