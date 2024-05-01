@extends('main')

@section('title', 'Accueil')

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
                            <p>L'association Joie et Gym est avant tout là pour votre bien-être.<br>Nous vous aidons à rester en forme et « à mieux vieillir ».</p>
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
                            <h3>Envie de vous inscrire ?</h3>
                            <p>Retrouvez toutes les étapes pour nous rejoindre</p>
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
                <div class="col">
                    <p>
                        L'association a obtenu en 2022 le <strong>" Label Qualité Club Sport Santé "</strong> qui garantit une vie associative
                        de qualité, avec un encadrement Sport Santé professionnel, adapté aux attentes et capacités de ses pratiquants,
                        avec des actions centrées sur le bien-être et le Sport Santé.
                    </p>
                </div>
            </div>
            <div class="mt-3">
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
                    <li>Dance Move type Zumba, Gym Méthode Pilates</li>
                    <li>Bodysculpt-Musculation, Renforcement Musculaire</li>
                    <li>Equilibre et Coordination Seniors</li>
                </ul>
                <p>
                    Les cours ont lieu du lundi au samedi midi durant toute
                    l'année scolaire, en journée et en soirée.<br>
                    Pour le plaisir de tous, c'est dans une ambiance chaleureuse et conviviale que nos animateurs diplômés dispensent aux adhérents
                    des cours variés et animés, correspondants aux attentes de chacun.
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
        <div class="row align-items-center justify-content-center mt-5">
            <p class="text-center lead"><strong>Les municipalités d'Epinay-sous-Sénart, Boussy-Saint-Antoine et Varennes-Jarcy, mettent des salles à notre disposition :</strong></p>
        </div>
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/La_Ferme_Boussy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">La Ferme<br>
                            Boussy-Saint-Antoine</h5>
                        <a href="https://maps.app.goo.gl/gGfTc2QzfftbktuA7" target="_blank">Chemin de la Ferme, 91800 Boussy-Saint-Antoine</a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Gymnase_Cosec_Boussy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Le gymnase COSEC<br>
                            Boussy-Saint-Antoine</h5>
                        <a href="https://maps.app.goo.gl/zEAnWVE337FJbAwN7" target="_blank">10 Rue des Glaises, 91800 Boussy-Saint-Antoine</a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Sénart_Club_Epinay.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">La salle du Sénart-Club<br>
                            Epinay-Sous-Sénart</h5>
                        <a href="https://maps.app.goo.gl/1JukNH1uT6JnREWQ7" target="_blank">40 bis Rue de la Croix Rochopt, 91860 Épinay-sous-Sénart</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Ancienne_Mairie_Epinay.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">L'ancienne Mairie<br>
                            Epinay-Sous-Sénart</h5>
                        <a href="https://maps.app.goo.gl/tKt7BRZucLZwiYz16" target="_blank">17 Rue de Boussy, 91860 Épinay-sous-Sénart</a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Mairie_Varennes.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Salle à la Mairie<br>
                            Varennes-Jarcy</h5>
                        <a href="https://maps.app.goo.gl/QBiZNktZTygX3X6N7" target="_blank">2 Pl. Aristide Briand, 94520 Varennes-Jarcy</a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Gymnase_Antonins_Boussy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Salle des Antonins<br>
                            Boussy-Saint-Antoine</h5>
                        <a href="https://maps.app.goo.gl/PQB1ScaQJqVS35KKA" target="_blank">Les Friches, 91800 Boussy-Saint-Antoine</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-5">
            <p class="text-center lead"><strong>Les séances de Gym Aquatique se déroulent :</strong></p>
        </div>
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Piscine_Senart_Boussy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">La Piscine des Sénarts<br>
                            Boussy-Saint-Antoine</h5>
                        <a href="https://maps.app.goo.gl/ad63VqWYpqdfGrde9" target="_blank">1 Rue de Rochopt, 91800 Boussy-Saint-Antoine</a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Piscine_Brunoy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">La Piscine Yves Moreau<br>
                            Brunoy</h5>
                        <a href="https://maps.app.goo.gl/aaH3EFLU6PVHqzuYA" target="_blank">4 Av. de Soulins, 91800 Brunoy</a>
{{--                        <p class="card-text text-muted">(En attente)</p>--}}
                    </div>
                </div>
            </div>
{{--            <div class="col d-flex justify-content-center align-items-center">--}}
{{--                <div class="card mt-2" style="width: 18rem;">--}}
{{--                    <img src="{{ asset('/assets/images/cards/Piscine_Epinay.jpg') }}" class="card-img-top" alt="...">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title">La Piscine Pierre Bonningue<br>--}}
{{--                            Epinay-Sous-Sénart</h5>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>

@endsection
