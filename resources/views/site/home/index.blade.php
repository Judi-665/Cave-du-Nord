@extends('layouts.site')

@section('title', 'Cave du Nord - Accueil')

@section('content')

<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(rgba(139, 28, 28, 0.7), rgba(44, 24, 16, 0.8)), url('https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?q=80&w=2070') center/cover; min-height: 90vh; display: flex; align-items: center; color: white;">
    <div class="container text-center">
        <h1 class="display-2 fw-bold mb-4" data-aos="fade-down" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.5);">
            Bienvenue à la Cave du Nord
        </h1>
        <p class="lead mb-5" data-aos="fade-up" data-aos-delay="200" style="font-size: 1.5rem; max-width: 700px; margin: 0 auto;">
            Découvrez une sélection exceptionnelle de vins et une gastronomie raffinée
        </p>
        <div data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('site.vins') }}" class="btn btn-lg me-3" style="background: var(--secondary-color); color: var(--dark-color); font-weight: 600; padding: 15px 40px; border-radius: 50px;">
                <i class="fas fa-wine-glass me-2"></i>Découvrir nos vins
            </a>
            <a href="{{ route('site.menus') }}" class="btn btn-outline-light btn-lg" style="padding: 15px 40px; border-radius: 50px; border-width: 2px;">
                <i class="fas fa-utensils me-2"></i>Notre carte
            </a>
        </div>
    </div>
</section>

<!-- Statistiques -->
<section class="py-5" style="background: var(--light-color);">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4 mb-md-0" data-aos="fade-up">
                <div class="stat-box">
                    <i class="fas fa-wine-bottle fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h2 class="display-4 fw-bold" style="color: var(--primary-color);">{{ $totalVins }}</h2>
                    <p class="lead">Vins d'Exception</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-box">
                    <i class="fas fa-utensils fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h2 class="display-4 fw-bold" style="color: var(--primary-color);">{{ $totalMenus }}</h2>
                    <p class="lead">Plats Gastronomiques</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-box">
                    <i class="fas fa-images fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h2 class="display-4 fw-bold" style="color: var(--primary-color);">{{ $totalGaleries }}</h2>
                    <p class="lead">Moments Capturés</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- À propos -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="{{ asset('images/cave.jpg') }}"  
                     alt="Cave du Nord" 
                     class="img-fluid rounded shadow-lg" 
                     style="width: 100%; max-width: 600px; border-radius: 20px !important;">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="display-5 fw-bold mb-4" style="color: var(--primary-color);">
                    Notre Histoire
                </h2>
                <p class="lead mb-4">
                    Depuis notre création, la Cave du Nord s'est imposée comme une référence incontournable 
                    pour les amateurs de vins fins et de cuisine gastronomique.
                </p>
                <p class="mb-4">
                    Notre cave soigneusement constituée vous propose une sélection rigoureuse de vins 
                    du monde entier, accompagnée d'une carte gastronomique qui sublime chaque bouteille.
                </p>
                <div class="d-flex gap-4 mb-4">
                    <div>
                        <i class="fas fa-check-circle fa-2x mb-2" style="color: var(--secondary-color);"></i>
                        <p class="fw-bold">Qualité Premium</p>
                    </div>
                    <div>
                        <i class="fas fa-award fa-2x mb-2" style="color: var(--secondary-color);"></i>
                        <p class="fw-bold">Service d'Excellence</p>
                    </div>
                    <div>
                        <i class="fas fa-heart fa-2x mb-2" style="color: var(--secondary-color);"></i>
                        <p class="fw-bold">Passion du Vin</p>
                    </div>
                </div>
                <a href="{{ route('site.contact') }}" class="btn btn-lg" style="background: var(--primary-color); color: white; padding: 12px 35px; border-radius: 50px;">
                    En savoir plus
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Aperçu des Vins -->
@if($vins->count() > 0)
<section class="section-padding" style="background: var(--light-color);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="color: var(--primary-color);">
                Notre Sélection de Vins
            </h2>
            <p class="lead">Découvrez nos dernières acquisitions</p>
        </div>
        
        <div class="row">
            @foreach($vins as $index => $vin)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                    <img src="{{ asset('storage/' . $vin->image) }}" 
                         class="card-img-top" 
                         alt="{{ $vin->nom }}" 
                         style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: var(--primary-color);">{{ $vin->nom }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($vin->description, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0 fw-bold" style="color: var(--secondary-color);">
                                {{ number_format($vin->prix, 0, ',', ' ') }} FCFA
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('site.vins') }}" class="btn btn-lg" style="background: var(--primary-color); color: white; padding: 12px 40px; border-radius: 50px;">
                Voir tous les vins <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Aperçu des Menus -->
@if($menus->count() > 0)
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="color: var(--primary-color);">
                Notre Carte Gastronomique
            </h2>
            <p class="lead">Des plats qui subliment vos vins</p>
        </div>
        
        <div class="row">
            @foreach($menus->take(6) as $index => $menu)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                    <img src="{{ asset('storage/' . $menu->image) }}" 
                         class="card-img-top" 
                         alt="{{ $menu->nom }}" 
                         style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        @if($menu->type)
                        <span class="badge mb-2" style="background: var(--secondary-color); color: var(--dark-color);">
                            {{ $menu->type }}
                        </span>
                        @endif
                        <h5 class="card-title fw-bold" style="color: var(--primary-color);">{{ $menu->nom }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($menu->description, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0 fw-bold" style="color: var(--secondary-color);">
                                {{ number_format($menu->prix, 0, ',', ' ') }} FCFA
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('site.menus') }}" class="btn btn-lg" style="background: var(--primary-color); color: white; padding: 12px 40px; border-radius: 50px;">
                Découvrir notre carte <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Aperçu Galerie -->
@if($galeries->count() > 0)
<section class="section-padding" style="background: var(--light-color);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="color: var(--primary-color);">
                Notre Galerie
            </h2>
            <p class="lead">Plongez dans notre univers</p>
        </div>
        
        <div class="row g-3">
            @foreach($galeries->take(8) as $index => $galerie)
            <div class="col-lg-3 col-md-4 col-6" data-aos="zoom-in" data-aos-delay="{{ $index * 50 }}">
                <div style="position: relative; overflow: hidden; border-radius: 15px; height: 200px;">
                    <img src="{{ asset('storage/' . $galerie->image) }}" 
                         alt="{{ $galerie->legende ?? 'Image' }}" 
                         class="img-fluid w-100 h-100" 
                         style="object-fit: cover; transition: transform 0.3s;" 
                         onmouseover="this.style.transform='scale(1.1)'" 
                         onmouseout="this.style.transform='scale(1)'">
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('site.galerie') }}" class="btn btn-lg" style="background: var(--primary-color); color: white; padding: 12px 40px; border-radius: 50px;">
                Voir toute la galerie <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="section-padding text-white" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);">
    <div class="container text-center">
        <div data-aos="fade-up">
            <h2 class="display-4 fw-bold mb-4">Réservez Votre Table</h2>
            <p class="lead mb-5" style="max-width: 700px; margin: 0 auto;">
                Vivez une expérience gastronomique inoubliable dans un cadre élégant et chaleureux
            </p>
            <a href="{{ route('site.contact') }}" class="btn btn-lg" style="background: var(--secondary-color); color: var(--dark-color); padding: 15px 50px; border-radius: 50px; font-weight: 600;">
                <i class="fas fa-phone me-2"></i>Nous contacter
            </a>
        </div>
    </div>
</section>

@endsection