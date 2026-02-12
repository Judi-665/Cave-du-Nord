@extends('layouts.site')

@section('title', 'Galerie Photos - Cave du Nord')

@push('styles')
<!-- GLightbox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
@endpush

@section('content')

<!-- Header de la page -->
<section class="page-header" style="background: linear-gradient(rgba(139, 28, 28, 0.85), rgba(44, 24, 16, 0.85)), url('https://images.unsplash.com/photo-1555244162-803834f70033?q=80&w=2070') center/cover; padding: 120px 0 80px; color: white;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-down">Notre Galerie</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="200">
            Plongez dans l'ambiance de Cave du Nord
        </p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="400">
            <ol class="breadcrumb justify-content-center" style="background: transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: var(--secondary-color);">Accueil</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Galerie</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Galerie d'images -->
<section class="section-padding">
    <div class="container">
        @if($galeries->count() > 0)
            <div class="row g-4" id="galerieContainer">
                @foreach($galeries as $index => $galerie)
                <div class="col-lg-4 col-md-6 col-sm-6" data-aos="zoom-in" data-aos-delay="{{ $index * 50 }}">
                    <a href="{{ asset('storage/' . $galerie->image) }}" 
                       class="glightbox galerie-item" 
                       data-gallery="galerie"
                       data-glightbox="title: {{ $galerie->legende ?? 'Cave du Nord' }}; description: ;">
                        <div style="position: relative; overflow: hidden; border-radius: 15px; height: 350px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); cursor: pointer;">
                            <img src="{{ asset('storage/' . $galerie->image) }}" 
                                 alt="{{ $galerie->legende ?? 'Image' }}" 
                                 class="img-fluid w-100 h-100" 
                                 style="object-fit: cover; transition: transform 0.5s;">
                            
                            <!-- Overlay -->
                            <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, rgba(139, 28, 28, 0.8), transparent); opacity: 0; transition: opacity 0.3s; display: flex; align-items: flex-end; padding: 20px;">
                                @if($galerie->legende)
                                <div class="text-white">
                                    <p class="mb-0 fw-bold">{{ $galerie->legende }}</p>
                                </div>
                                @endif
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                    <i class="fas fa-search-plus fa-2x text-white"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-images fa-4x mb-4" style="color: var(--primary-color); opacity: 0.3;"></i>
                <h3 class="text-muted">Aucune image disponible pour le moment</h3>
                <p class="text-muted">Revenez bientôt découvrir nos photos</p>
            </div>
        @endif
    </div>
</section>

<!-- Section Instagram -->
<section class="py-5" style="background: var(--light-color);">
    <div class="container text-center">
        <div data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="color: var(--primary-color);">
                <i class="fab fa-instagram me-2"></i>Suivez-nous sur Instagram
            </h2>
            <p class="lead mb-4">Restez connectés pour découvrir nos dernières actualités</p>
            <a href="#" target="_blank" class="btn btn-lg" style="background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); color: white; padding: 12px 40px; border-radius: 50px; font-weight: 600;">
                <i class="fab fa-instagram me-2"></i>@cavedunord
            </a>
        </div>
    </div>
</section>

<!-- Call to action -->
<section class="section-padding text-white text-center" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);">
    <div class="container" data-aos="fade-up">
        <h3 class="mb-3">Venez découvrir notre établissement</h3>
        <p class="lead mb-4">Une ambiance unique vous attend</p>
        <a href="{{ route('site.contact') }}" class="btn btn-lg" style="background: var(--secondary-color); color: var(--dark-color); padding: 12px 40px; border-radius: 50px; font-weight: 600;">
            <i class="fas fa-map-marker-alt me-2"></i>Nous trouver
        </a>
    </div>
</section>

@endsection

@push('scripts')
<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser GLightbox
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        autoplayVideos: true
    });
    
    // Effet hover sur les images
    document.querySelectorAll('.galerie-item').forEach(item => {
        const overlay = item.querySelector('.overlay');
        const img = item.querySelector('img');
        
        item.addEventListener('mouseenter', function() {
            if (overlay) overlay.style.opacity = '1';
            if (img) img.style.transform = 'scale(1.1)';
        });
        
        item.addEventListener('mouseleave', function() {
            if (overlay) overlay.style.opacity = '0';
            if (img) img.style.transform = 'scale(1)';
        });
    });
});
</script>
@endpush