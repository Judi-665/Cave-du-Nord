<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        // Récupérer TOUS les menus et les grouper par type
        $menus = Menu::orderBy('type')->orderBy('nom')->get();
        
        // Grouper les menus par type
        $menusParType = $menus->groupBy('type');
        
        return view('site.menus.index', compact('menusParType', 'menus'));
    }
}