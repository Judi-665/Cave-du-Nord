<footer class="footer-custom">
    <div class="container">
        <div class="row">
            <!-- À propos -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5><i class="fas fa-wine-bottle me-2"></i>Cave du Nord</h5>
                <p class="mb-3">
                    Découvrez notre sélection exceptionnelle de vins et notre cuisine raffinée. 
                    Une expérience gastronomique unique vous attend.
                </p>
                <div class="social-icons">
                    <a href="#" target="_blank" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" target="_blank" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" target="_blank" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" target="_blank" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <!-- Liens rapides -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5>Navigation</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-chevron-right me-2"></i>Accueil
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('site.vins') }}">
                            <i class="fas fa-chevron-right me-2"></i>Nos Vins
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('site.menus') }}">
                            <i class="fas fa-chevron-right me-2"></i>Notre Carte
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('site.galerie') }}">
                            <i class="fas fa-chevron-right me-2"></i>Galerie
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('site.contact') }}">
                            <i class="fas fa-chevron-right me-2"></i>Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Horaires -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Horaires d'ouverture</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-clock me-2" style="color: var(--secondary-color);"></i>
                        <strong>Lundi - Vendredi</strong><br>
                        <span class="ms-4">11h00 - 23h00</span>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-clock me-2" style="color: var(--secondary-color);"></i>
                        <strong>Samedi - Dimanche</strong><br>
                        <span class="ms-4">10h00 - 00h00</span>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Contactez-nous</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt me-2" style="color: var(--secondary-color);"></i>
                        Porto-Novo, Bénin
                    </li>
                    <li class="mb-2">
                        <a href="tel:+22900000000" style="color: #ddd;">
                            <i class="fas fa-phone me-2" style="color: var(--secondary-color);"></i>
                            +229 00 00 00 00
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="mailto:contact@cavedunord.com" style="color: #ddd;">
                            <i class="fas fa-envelope me-2" style="color: var(--secondary-color);"></i>
                            contact@cavedunord.com
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <hr style="border-color: rgba(255,255,255,0.1); margin: 2rem 0 1rem;">

        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">
                    &copy; {{ date('Y') }} Cave du Nord. Tous droits réservés.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="mb-0">
                    Conçu avec <i class="fas fa-heart" style="color: var(--secondary-color);"></i> 
                </p>
            </div>
        </div>
    </div>
</footer>