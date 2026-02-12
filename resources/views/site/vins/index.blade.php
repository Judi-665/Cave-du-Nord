@extends('layouts.site')

@section('title', 'Nos Vins - Cave du Nord')

@section('content')

<!-- Header de la page -->
<section class="page-header" style="background: linear-gradient(rgba(139, 28, 28, 0.85), rgba(44, 24, 16, 0.85)), url('https://images.unsplash.com/photo-1506377247377-2a5b3b417ebb?q=80&w=2070') center/cover; padding: 120px 0 80px; color: white;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-down">Notre Cave à Vins</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="200">
            Découvrez notre sélection exceptionnelle de vins du monde entier
        </p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="400">
            <ol class="breadcrumb justify-content-center" style="background: transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: var(--secondary-color);">Accueil</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Nos Vins</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Filtres et recherche -->
<section class="py-4" style="background: var(--light-color);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text" style="background: white; border-right: none;">
                        <i class="fas fa-search" style="color: var(--primary-color);"></i>
                    </span>
                    <input type="text" id="searchVin" class="form-control" placeholder="Rechercher un vin..." style="border-left: none;">
                </div>
            </div>
            <div class="col-md-4 mt-3 mt-md-0">
                <select id="sortVin" class="form-select">
                    <option value="recent">Plus récents</option>
                    <option value="prix-asc">Prix croissant</option>
                    <option value="prix-desc">Prix décroissant</option>
                    <option value="nom">Nom A-Z</option>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Catalogue des vins -->
<section class="section-padding">
    <div class="container">
        @if($vins->count() > 0)
            <div class="row" id="vinsContainer">
                @foreach($vins as $index => $vin)
                <div class="col-lg-4 col-md-6 mb-4 vin-item" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 50 }}"
                     data-nom="{{ strtolower($vin->nom) }}"
                     data-prix="{{ $vin->prix }}">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'">
                        <div style="position: relative; overflow: hidden; height: 350px;">
                            <img src="{{ asset('storage/' . $vin->image) }}" 
                                 class="card-img-top w-100 h-100" 
                                 alt="{{ $vin->nom }}" 
                                 style="object-fit: cover; transition: transform 0.5s;" 
                                 onmouseover="this.style.transform='scale(1.1)'" 
                                 onmouseout="this.style.transform='scale(1)'">
                            <div style="position: absolute; top: 15px; right: 15px;">
                                <span class="badge" style="background: var(--secondary-color); color: var(--dark-color); padding: 8px 15px; font-size: 0.9rem;">
                                    <i class="fas fa-wine-glass me-1"></i>Vin
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3" style="color: var(--primary-color); font-size: 1.3rem;">
                                {{ $vin->nom }}
                            </h5>
                            <p class="card-text text-muted mb-3" style="line-height: 1.7;">
                                {{ $vin->description }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center pt-3" style="border-top: 2px solid var(--light-color);">
                                <span class="h4 mb-0 fw-bold" style="color: var(--secondary-color);">
                                    {{ number_format($vin->prix, 0, ',', ' ') }} FCFA
                                </span>
                                <a href="{{ route('site.contact') }}" class="btn btn-sm" style="background: var(--primary-color); color: white; padding: 8px 20px; border-radius: 25px;">
                                    Commander
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Message si aucun résultat -->
            <div id="noResults" class="text-center py-5" style="display: none;">
                <i class="fas fa-wine-bottle fa-3x mb-3" style="color: var(--primary-color); opacity: 0.3;"></i>
                <h4 class="text-muted">Aucun vin trouvé</h4>
                <p class="text-muted">Essayez avec d'autres critères de recherche</p>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-wine-bottle fa-4x mb-4" style="color: var(--primary-color); opacity: 0.3;"></i>
                <h3 class="text-muted">Aucun vin disponible pour le moment</h3>
                <p class="text-muted">Revenez bientôt découvrir notre sélection</p>
            </div>
        @endif
    </div>
</section>

<!-- Call to action -->
<section class="py-5 text-white text-center" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);">
    <div class="container" data-aos="fade-up">
        <h3 class="mb-3">Besoin de conseils pour choisir votre vin ?</h3>
        <p class="lead mb-4">Notre sommelier est à votre disposition</p>
        <a href="{{ route('site.contact') }}" class="btn btn-lg" style="background: var(--secondary-color); color: var(--dark-color); padding: 12px 40px; border-radius: 50px; font-weight: 600;">
            <i class="fas fa-phone me-2"></i>Nous contacter
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchVin');
    const sortSelect = document.getElementById('sortVin');
    const vinsContainer = document.getElementById('vinsContainer');
    const noResults = document.getElementById('noResults');
    
    if (!vinsContainer) return;
    
    const vinItems = Array.from(document.querySelectorAll('.vin-item'));
    
    // Fonction de recherche
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            filterAndSort();
        });
    }
    
    // Fonction de tri
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            filterAndSort();
        });
    }
    
    function filterAndSort() {
        const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
        const sortValue = sortSelect ? sortSelect.value : 'recent';
        
        // Filtrer
        let visibleItems = vinItems.filter(item => {
            const nom = item.dataset.nom || '';
            const matches = nom.includes(searchTerm);
            item.style.display = matches ? '' : 'none';
            return matches;
        });
        
        // Trier
        visibleItems.sort((a, b) => {
            const prixA = parseFloat(a.dataset.prix);
            const prixB = parseFloat(b.dataset.prix);
            const nomA = a.dataset.nom;
            const nomB = b.dataset.nom;
            
            switch(sortValue) {
                case 'prix-asc':
                    return prixA - prixB;
                case 'prix-desc':
                    return prixB - prixA;
                case 'nom':
                    return nomA.localeCompare(nomB);
                default:
                    return 0;
            }
        });
        
        // Réorganiser le DOM
        visibleItems.forEach(item => {
            vinsContainer.appendChild(item);
        });
        
        // Afficher/masquer le message "aucun résultat"
        if (noResults) {
            noResults.style.display = visibleItems.length === 0 ? 'block' : 'none';
        }
    }
});
</script>
@endpush