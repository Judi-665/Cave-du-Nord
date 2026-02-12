@extends('admin.layout')

@section('content')
<div class="container-fluid" style="background-color: #f4e7e7; min-height: 100vh; padding: 40px 20px;">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="display-4 fw-bold" style="color: #6f1d1b;">Bienvenue dans le tableau de bord</h1>
            <p class="lead" style="color: #6f1d1b;">
                Gérez vos vins, vos menus et vos galeries depuis cet espace. Ajoutez, modifiez ou supprimez facilement vos éléments grâce aux formulaires et tableaux ci-dessous.
            </p>
        </div>

        <div class="d-flex align-items-center">
            <img src="{{ asset('images/profil.png') }}" alt="Admin" class="rounded-circle" 
                 style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px;">
            <div>
                <span style="font-weight: bold; color: #6f1d1b;">Admin</span>
                <p class="mb-0" style="color: #6f1d1b; font-size: 0.9rem;">Connecté</p>
            </div>
        </div>
    </div>

    <!-- Sections dynamiques -->
    <div id="content-sections">

        <!-- VINS -->
        <div id="vins" class="content-section">
            <div class="card text-white w-75 mx-auto mb-4" style="background-color: #8B1C1C;">
                <div class="card-body text-center py-5">
                    <h2>Vins</h2>
                    <p>Ajoutez, modifiez ou supprimez des vins.</p>
                    <button class="btn btn-light" id="show-vin-form" style="color: #8B1C1C;">Gérer</button>
                </div>
            </div>

            <!-- Formulaire + Tableau caché au départ -->
            <div id="vin-form-container" style="display:none;">
                @include('admin.vins.vin-form')
            </div>
        </div>

        <!-- MENUS -->
        <div id="menus" class="content-section" style="display:none;">
            <div class="card text-white w-75 mx-auto mb-4" style="background-color: #8B1C1C;">
                <div class="card-body text-center py-5">
                    <h2>Menus</h2>
                    <p>Administrez vos plats.</p>
                    <button class="btn btn-light" id="show-menu-form" style="color: #8B1C1C;">Gérer</button>
                </div>
            </div>

            <div id="menu-form-container" style="display:none;">
                @include('admin.menus.menu-form')
            </div>
        </div>

        <!-- GALERIE -->
        <div id="galeries" class="content-section" style="display:none;">
            <div class="card text-white w-75 mx-auto mb-4" style="background-color: #8B1C1C;">
                <div class="card-body text-center py-5">
                    <h2>Galerie</h2>
                    <p>Ajoutez ou supprimez des photos.</p>
                    <button class="btn btn-light" id="show-galerie-form" style="color: #8B1C1C;">Gérer</button>
                </div>
            </div>

            <div id="galerie-form-container" style="display:none;">
                @include('admin.galeries.galerie-form')
            </div>
        </div>

    </div>
</div>

<!-- JS pour switcher les sections et afficher les formulaires -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.switch-btn');
    const sections = document.querySelectorAll('.content-section');

    // Affiche Vins par défaut
    sections.forEach(sec => sec.style.display = 'none');
    document.getElementById('vins').style.display = 'block';

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const target = btn.getAttribute('data-target');
            sections.forEach(sec => sec.style.display = 'none');
            document.getElementById(target).style.display = 'block';
        });
    });

    // Afficher le formulaire + tableau au clic sur Gérer
    const formToggles = [
        {btn: 'show-vin-form', container: 'vin-form-container'},
        {btn: 'show-menu-form', container: 'menu-form-container'},
        {btn: 'show-galerie-form', container: 'galerie-form-container'}
    ];

    formToggles.forEach(f => {
        const button = document.getElementById(f.btn);
        const container = document.getElementById(f.container);
        if(button && container){
            button.addEventListener('click', () => {
                container.style.display = container.style.display === 'none' ? 'block' : 'none';
            });
        }
    });
});
</script>
@endsection