@extends('layouts.site')

@section('title', 'Notre Carte - Cave du Nord')

@section('content')

<!-- Header de la page -->
<section class="page-header" style="background: linear-gradient(rgba(139, 28, 28, 0.85), rgba(44, 24, 16, 0.85)), url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2070') center/cover; padding: 120px 0 80px; color: white;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-down">Notre Carte Gastronomique</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="200">
            Une cuisine raffinée pour sublimer vos dégustations
        </p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="400">
            <ol class="breadcrumb justify-content-center" style="background: transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: var(--secondary-color);">Accueil</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Notre Carte</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Filtres -->
<section class="py-4" style="background: var(--light-color);">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <button class="filter-btn active" data-filter="all" style="padding: 10px 30px; border: 2px solid var(--primary-color); background: var(--primary-color); color: white; border-radius: 25px; font-weight: 600; transition: all 0.3s;">
                Tous les plats
            </button>
            @foreach($menusParType as $type => $items)
                @if($type)
                <button class="filter-btn" data-filter="{{ strtolower($type) }}" style="padding: 10px 30px; border: 2px solid var(--primary-color); background: white; color: var(--primary-color); border-radius: 25px; font-weight: 600; transition: all 0.3s;">
                    {{ $type }} ({{ $items->count() }})
                </button>
                @endif
            @endforeach
        </div>
    </div>
</section>

<!-- Catalogue des menus -->
<section class="section-padding">
    <div class="container">
        @if($menus->count() > 0)
            <div class="row" id="menusContainer">
                @foreach($menus as $index => $menu)
                <div class="col-lg-4 col-md-6 mb-4 menu-item" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 50 }}"
                     data-type="{{ strtolower($menu->type ?? 'autre') }}">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'">
                        <div style="position: relative; overflow: hidden; height: 300px;">
                            <img src="{{ asset('storage/' . $menu->image) }}" 
                                 class="card-img-top w-100 h-100" 
                                 alt="{{ $menu->nom }}" 
                                 style="object-fit: cover; transition: transform 0.5s;" 
                                 onmouseover="this.style.transform='scale(1.1)'" 
                                 onmouseout="this.style.transform='scale(1)'">
                            @if($menu->type)
                            <div style="position: absolute; top: 15px; right: 15px;">
                                <span class="badge" style="background: var(--secondary-color); color: var(--dark-color); padding: 8px 15px; font-size: 0.9rem;">
                                    {{ $menu->type }}
                                </span>
                            </div>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3" style="color: var(--primary-color); font-size: 1.3rem;">
                                {{ $menu->nom }}
                            </h5>
                            <p class="card-text text-muted mb-3" style="line-height: 1.7;">
                                {{ $menu->description }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center pt-3" style="border-top: 2px solid var(--light-color);">
                                <span class="h4 mb-0 fw-bold" style="color: var(--secondary-color);">
                                    {{ number_format($menu->prix, 0, ',', ' ') }} FCFA
                                </span>
                                <button class="btn btn-sm" style="background: var(--primary-color); color: white; padding: 8px 20px; border-radius: 25px;">
                                    <i class="fas fa-utensils me-1"></i>Commander
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-utensils fa-4x mb-4" style="color: var(--primary-color); opacity: 0.3;"></i>
                <h3 class="text-muted">Aucun plat disponible pour le moment</h3>
                <p class="text-muted">Revenez bientôt découvrir notre carte</p>
            </div>
        @endif
    </div>
</section>

<!-- Section d'accords mets-vins -->
<section class="py-5" style="background: var(--light-color);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="color: var(--primary-color);">
                Accords Mets & Vins
            </h2>
            <p class="lead">Nos suggestions pour une expérience parfaite</p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="text-center p-4 h-100" style="background: white; border-radius: 15px;">
                    <i class="fas fa-fish fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h4 class="fw-bold mb-3">Poissons & Fruits de mer</h4>
                    <p class="text-muted">Vins blancs secs et légers</p>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center p-4 h-100" style="background: white; border-radius: 15px;">
                    <i class="fas fa-drumstick-bite fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h4 class="fw-bold mb-3">Viandes rouges</h4>
                    <p class="text-muted">Vins rouges corsés et tanniques</p>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="text-center p-4 h-100" style="background: white; border-radius: 15px;">
                    <i class="fas fa-cheese fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h4 class="fw-bold mb-3">Fromages</h4>
                    <p class="text-muted">Vins blancs ou rouges selon l'affinage</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to action -->
<section class="section-padding text-white text-center" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);">
    <div class="container" data-aos="fade-up">
        <h3 class="mb-3">Réservez votre table dès maintenant</h3>
        <p class="lead mb-4">Profitez d'une expérience gastronomique unique</p>
        <a href="{{ route('site.contact') }}" class="btn btn-lg" style="background: var(--secondary-color); color: var(--dark-color); padding: 12px 40px; border-radius: 50px; font-weight: 600;">
            <i class="fas fa-calendar-alt me-2"></i>Réserver une table
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const menuItems = document.querySelectorAll('.menu-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Mettre à jour les boutons actifs
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.style.background = 'white';
                b.style.color = 'var(--primary-color)';
            });
            
            this.classList.add('active');
            this.style.background = 'var(--primary-color)';
            this.style.color = 'white';
            
            // Filtrer les items
            menuItems.forEach(item => {
                if (filter === 'all' || item.dataset.type === filter) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush