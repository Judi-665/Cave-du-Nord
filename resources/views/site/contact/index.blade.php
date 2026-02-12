@extends('layouts.site')

@section('title', 'Contactez-nous - Cave du Nord')

@section('content')

<!-- Header de la page -->
<section class="page-header" style="background: linear-gradient(rgba(139, 28, 28, 0.85), rgba(44, 24, 16, 0.85)), url('https://images.unsplash.com/photo-1521017432531-fbd92d768814?q=80&w=2070') center/cover; padding: 120px 0 80px; color: white;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-down">Contactez-nous</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="200">
            Nous sommes à votre écoute
        </p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="400">
            <ol class="breadcrumb justify-content-center" style="background: transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: var(--secondary-color);">Accueil</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Contact</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Section principale -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Formulaire de contact -->
            <div class="col-lg-7 mb-5 mb-lg-0" data-aos="fade-right">
                <div class="p-4 p-md-5" style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    <h2 class="fw-bold mb-4" style="color: var(--primary-color);">
                        <i class="fas fa-envelope me-2"></i>Envoyez-nous un message
                    </h2>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('site.contact.send') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="nom" class="form-label fw-bold">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('nom') is-invalid @enderror" 
                                       id="nom" 
                                       name="nom" 
                                       value="{{ old('nom') }}"
                                       required
                                       style="padding: 12px; border-radius: 10px;">
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       required
                                       style="padding: 12px; border-radius: 10px;">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="sujet" class="form-label fw-bold">Sujet <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('sujet') is-invalid @enderror" 
                                   id="sujet" 
                                   name="sujet" 
                                   value="{{ old('sujet') }}"
                                   required
                                   style="padding: 12px; border-radius: 10px;">
                            @error('sujet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label fw-bold">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" 
                                      name="message" 
                                      rows="6" 
                                      required
                                      style="padding: 12px; border-radius: 10px;">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-lg w-100" style="background: var(--primary-color); color: white; padding: 15px; border-radius: 10px; font-weight: 600;">
                            <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Informations de contact -->
            <div class="col-lg-5" data-aos="fade-left">
                <!-- Coordonnées -->
                <div class="mb-4 p-4" style="background: var(--light-color); border-radius: 15px;">
                    <h4 class="fw-bold mb-4" style="color: var(--primary-color);">
                        <i class="fas fa-info-circle me-2"></i>Nos Coordonnées
                    </h4>

                    <div class="mb-3 d-flex align-items-start">
                        <div class="me-3" style="width: 40px; height: 40px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Adresse</h6>
                            <p class="mb-0 text-muted">Porto-Novo, Bénin</p>
                        </div>
                    </div>

                    <div class="mb-3 d-flex align-items-start">
                        <div class="me-3" style="width: 40px; height: 40px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Téléphone</h6>
                            <a href="tel:+22900000000" class="text-muted text-decoration-none">+229 00 00 00 00</a>
                        </div>
                    </div>

                    <div class="mb-3 d-flex align-items-start">
                        <div class="me-3" style="width: 40px; height: 40px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Email</h6>
                            <a href="mailto:contact@cavedunord.com" class="text-muted text-decoration-none">contact@cavedunord.com</a>
                        </div>
                    </div>
                </div>

                <!-- Horaires -->
                <div class="mb-4 p-4" style="background: var(--primary-color); color: white; border-radius: 15px;">
                    <h4 class="fw-bold mb-4">
                        <i class="fas fa-clock me-2"></i>Horaires d'ouverture
                    </h4>
                    
                    <div class="mb-3 d-flex justify-content-between">
                        <span class="fw-bold">Lundi - Vendredi</span>
                        <span>11h00 - 23h00</span>
                    </div>
                    
                    <div class="mb-3 d-flex justify-content-between">
                        <span class="fw-bold">Samedi - Dimanche</span>
                        <span>10h00 - 00h00</span>
                    </div>

                    <div class="alert alert-light mt-3 mb-0">
                        <i class="fas fa-info-circle me-2" style="color: var(--primary-color);"></i>
                        <small style="color: var(--dark-color);">Réservation recommandée pour les groupes de plus de 6 personnes</small>
                    </div>
                </div>

                <!-- Réseaux sociaux -->
                <div class="p-4 text-center" style="background: var(--light-color); border-radius: 15px;">
                    <h4 class="fw-bold mb-4" style="color: var(--primary-color);">
                        <i class="fas fa-share-alt me-2"></i>Suivez-nous
                    </h4>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="btn btn-lg" style="width: 50px; height: 50px; border-radius: 50%; background: #1877f2; color: white; display: flex; align-items: center; justify-content: center;" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-lg" style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); color: white; display: flex; align-items: center; justify-content: center;" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-lg" style="width: 50px; height: 50px; border-radius: 50%; background: #25D366; color: white; display: flex; align-items: center; justify-content: center;" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#" class="btn btn-lg" style="width: 50px; height: 50px; border-radius: 50%; background: #1DA1F2; color: white; display: flex; align-items: center; justify-content: center;" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Carte Google Maps -->
<section class="py-0">
    <div style="height: 450px; width: 100%;">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.682477547583!2d2.6288!3d6.4969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMjknNDguOCJOIDLCsDM3JzQzLjciRQ!5e0!3m2!1sfr!2sbj!4v1234567890!5m2!1sfr!2sbj" 
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>

<
<section class="section-padding" style="background: var(--light-color);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="color: var(--primary-color);">
                Questions Fréquentes
            </h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-3" style="border-radius: 10px; overflow: hidden;" data-aos="fade-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" style="background: white; color: var(--primary-color);">
                                Acceptez-vous les réservations ?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Oui, nous acceptons les réservations par téléphone ou via notre formulaire de contact. Les réservations sont fortement recommandées pour les groupes de plus de 6 personnes.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3" style="border-radius: 10px; overflow: hidden;" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" style="background: white; color: var(--primary-color);">
                                Proposez-vous des menus pour végétariens ?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Oui, notre carte propose plusieurs options végétariennes. N'hésitez pas à nous contacter pour des demandes spécifiques.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3" style="border-radius: 10px; overflow: hidden;" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" style="background: white; color: var(--primary-color);">
                                Peut-on acheter des vins à emporter ?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Absolument ! Tous nos vins sont disponibles à la vente pour emporter. Demandez conseil à notre sommelier pour faire votre choix.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0" style="border-radius: 10px; overflow: hidden;" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" style="background: white; color: var(--primary-color);">
                                Organisez-vous des événements privés ?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Oui, nous pouvons privatiser notre espace pour vos événements : anniversaires, soirées d'entreprise, dégustations privées, etc. Contactez-nous pour plus d'informations.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection