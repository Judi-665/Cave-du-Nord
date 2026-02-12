<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    $menu = \App\Models\Menu::create([
        'nom' => 'Test Plat',
        'type' => 'Entrée',
        'prix' => 5000,
        'description' => 'Description test',
        'image' => 'test.jpg'
    ]);
    
    echo "✅ Menu créé avec succès ! ID: " . $menu->id;
} catch (\Exception $e) {
    echo "❌ Erreur: " . $e->getMessage();
}