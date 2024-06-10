@extends('main')

@section('title', 'Accueil')

@php
    $animateurs = [
        'Eric' => 'Aquagym Brunoy',
        'Paul' => 'Aquagym Boussy',
        'Rémi' => 'Aquagym Boussy',
        'Fabrice' => 'Danse-Move, Gym Entretien, <br>
         Abdo-Fessiers Etirements',
        'Isabelle' => 'Souplesse-Etirements',
        'Joëlle' => 'Body Zen, Gym Entretien, <br>
        Stretching Postural, Equilibre et Coordination Séniors, <br>
         Taille Abdo-Fessiers',
        'Luckie' => 'Stretching Postural',
        'Mary' => 'Yoga',
        'Nathalie' => 'Souplesse Etirements, Body Zen, <br>
         Gym Détente Méthodes Pilates',
        'Rose Marie' => 'Gym Douce, Gym Forme, <br>
        Bodysculpt-Musculation',
        'Vincent' => 'Gym Musculaire, Gym Tonic, <br>
         Renforcement Musculaire',
        'Virginie' => 'Yoga Nidra',
    ];
    $bureau = [
        'Gabriele MAKKAOUI' => 'Présidente',
        'Catherine SCHMITT' => 'Vice-Présidente',
        'Michèle FLAMEN' => 'Secrétaire',
        'Michelle ROUSSEAU' => 'Secrétaire Adjointe',
        'Claudine LE CHAUDELEC' => 'Trésorière',
        'Gérard AUSSEIL' => 'Membre',
        'Danièle CAMPION' => 'Membre',
        'Marie-Bernadette CHORON' => 'Membre',
        'Danielle COUVREUX' => 'Membre',
        'Bernadette MANSOUR' => 'Membre',
        'Françoise MOGUET' => 'Membre',
    ];
@endphp

@section('content')
    <div id="carousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div id="carousel-item-1" class="carousel-item active">
                <div class="container">
                    <div class="row align-items-center justify-content-center flex-column flex-md-row">
                        <div class="col mt-4" style="@media screen and (min-width: 768px) {
                        margin-left: 10%
                        }">
                            <h3>Apprenez à nous connaitre</h3>
                            <p>L'association Joie et Gym est avant tout là pour votre bien-être.<br>Nous vous aidons à rester en bonne forme.</p>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <img src="{{ asset('/assets/images/carousel/1.png') }}" class="d-block m-5" alt="Logo Joie et Gym" height="300" width="298">
                        </div>
                    </div>
                </div>
            </div>
            <div id="carousel-item-2" class="carousel-item">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col mt-4" style="@media screen and (min-width: 768px) {
                        margin-left: 10%
                        }">
                            <h3>Envie de nous rejoindre ?</h3>
                            <p>Retrouvez toutes les étapes pour vous inscrire</p>
                            <a href="{{ route('inscription') }}" class="btn btn-primary">Cliquez ici</a>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <img src="{{ asset('/assets/images/carousel/2.png') }}" class="d-block m-5" alt="Gym 1" height="300" width="450">
                        </div>
                    </div>
                </div>
            </div>
            <div id="carousel-item-3" class="carousel-item">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col mt-4" style="@media screen and (min-width: 768px) {
                        margin-left: 10%
                        }">
                            <h3>Des cours variés</h3>
                            <p>Répartis sur toute la semaine du Lundi au Samedi</p>
                            <a href="{{ route('planning') }}" class="btn btn-primary">Voir le planning</a>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <img src="{{ asset('/assets/images/carousel/3.png') }}" class="d-block m-5" alt="Gym 2" height="300" width="450">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <h2 class="mt-5 text-center">Notre association :</h2>
        <div class="row align-items-center justify-content-center">
            <div class="col">
                <p>
                    Association à but non lucratif régie par la loi de 1901 et affiliée à la Fédération Française d'Education Physique et de Gymnastique Volontaire (FFEPGV). <br>
                    <strong>Joie et Gymnastique au Val d'Yerres</strong> est présente sur le territoire depuis plus de 50 ans, et propose des séances d'activités sportives
                            et physiques diverses, accessibles à tous les âges dès 16 ans révolus.
                </p>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <img src="{{ asset('/assets/images/Logo_FFEPGV_420x420.png') }}" class="d-block mx-auto" alt="Logo FFEPGV" height="'420'" width="420">
            </div>
        </div>
        <div class="row align-items-center justify-content-center text-center mt-5">
            <div class="row align-items-center justify-content-center mt-5">
                <div class="col d-flex justify-content-center align-items-center">
                    <img src="{{ asset('/assets/images/logo_epgv.png') }}" class="d-block mx-auto" alt="Logo Sport et santé" height="250" width="432">
                </div>
                <div class="col-md-7 text-start">
                    <p>
                        L'association a obtenu en 2022 le <strong>" Label Qualité Club Sport Santé "</strong> qui garantit une vie associative
                        de qualité, avec un encadrement Sport Santé professionnel, adapté aux attentes et capacités de ses pratiquants,<br>
                        avec des actions centrées sur le bien-être et le Sport Santé.
                    </p>
                </div>
            </div>
            <div class="mt-4">
                <p>
                    Pour répondre aux besoins, aux envies et aux disponibilités de tous, notre programme offre près de 40 heures de cours par semaine
                    à un prix attractif où chacun peut pratiquer en <strong>" illimité "</strong> (hors options*) différentes disciplines sport-santé telles que :
                </p>
                <ul class="fw-bold fs-5 list-unstyled">
                    <li>Gym Entretien, Gym Form', Gym Tonic</li>
                    <li>Stretching Postural*, Souplesse-Etirements</li>
                    <li>Taille Abdos-Fessiers, Gym Musculaire</li>
                    <li>Aquagym*</li>
                    <li>Yoga*, Yoga Nidra*, Body Zen, Gym Douce</li>
                    <li>Dance Move, Gym Méthode Pilates</li>
                    <li>Bodysculpt-Musculation, Renforcement Musculaire</li>
                    <li>Equilibre et Coordination Seniors</li>
                </ul>
                <p>
                    Les cours ont lieu du lundi au samedi midi durant toute
                    l'année scolaire, en journée et en soirée.<br>
                    Pour le plaisir de tous, c'est dans une ambiance chaleureuse et conviviale que nos animateurs diplômés dispensent aux adhérents
                    des cours variés et animés, correspondant aux attentes de chacun.
                </p>
                <p>
                    <a href="{{ route('planning') }}">Consultez notre planning de la saison 2023-2024</a>
                </p>
            </div>
        </div>

        <div class="row align-items-center justify-content-center mt-5">
            <div class="col d-flex justify-content-center align-items-center">
                <a href="https://www.ville-epinay-senart.fr/" target="_blank">
                    <img src="{{ asset('/assets/images/logo_epinay.svg') }}" class="d-block mx-auto" alt="Logo Epinay-sous-Senart" height="200" width="200">
                </a>
            </div>
            <div class="col d-flex align-items-center justify-content-center">
                <a href="https://www.ville-boussy.fr/" target="_blank">
                    <img src="{{ asset('/assets/images/logo_boussy.png') }}" class="d-block mx-auto" alt="Logo Boussy-Saint-Antoine" height="72.19" width="200">
                </a>
            </div>
            <div class="col d-flex align-items-center justify-content-center">
                <a href="https://www.varennesjarcy.fr/" target="_blank">
                    <img src="{{ asset('/assets/images/logo_varennes.png') }}" class="d-block mx-auto" alt="Logo Varennes Jarcy" height="102.4" width="200">
                </a>
            </div>
        </div>

        <h2 class="my-5 text-center">Nos Animateurs</h2>
        <div class="row">
            <!-- Animateurs -->
            <div class="col-12 d-flex flex-wrap justify-content-center">
                @foreach($animateurs as $animateur => $description)
                    <div class="p-3 text-center">
{{--                        <img src="{{ asset('/assets/images/animateurs/'.$animateur.'.jpg') }}" class="rounded-circle mb-2" alt="Photo de {{ $animateur }}" width="150" height="150">--}}
                        <img src="{{ asset('/assets/images/placeholder_profile.png') }}" class="rounded-circle mb-2" alt="Photo de {{ $animateur }}" width="150" height="150">
                        <h5>{{ $animateur }}</h5>
                        <p class="text-muted">{!! $description !!}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <h2 class="my-5 text-center">Les Membres du Bureau</h2>
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-center">
                @foreach($bureau as $membre => $role)
                    <div class="p-3 text-center">
{{--                        <img src="{{ asset('/assets/images/bureau/'.$membre.'.jpg') }}" class="rounded-circle mb-2" alt="Photo de {{ $membre }}" width="150" height="150">--}}
                        <img src="{{ asset('/assets/images/placeholder_profile.png') }}" class="rounded-circle mb-2" alt="Photo de {{ $membre }}" width="150" height="150">
                        <h5>{{ $membre }}</h5>
                        <p class="text-muted">{{ $role }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection
