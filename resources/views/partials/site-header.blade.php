<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-cave-du-nord.png') }}" alt="Cave du Nord" style="height: 70px; margin-right: 10px;">
            <span>Cave du Nord</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i>Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.vins') }}">
                        <i class="fas fa-wine-glass me-1"></i>Nos Vins
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.menus') }}">
                        <i class="fas fa-utensils me-1"></i>Notre Carte
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.galerie') }}">
                        <i class="fas fa-images me-1"></i>Galerie
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.contact') }}">
                        <i class="fas fa-envelope me-1"></i>Contact
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.contact') }}">
                        <i class="fas fa-microphone-alt me-1"></i>Animation
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div style="height: 76px;"></div>