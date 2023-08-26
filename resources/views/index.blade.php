@extends('main')

@section('title', 'Joie et Gym | Accueil')

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
                            <p>L'association Joie et Gym est avant tout là pour votre bien-être.<br>Nous vous aidons à rester en forme !</p>
{{--                            <a href="#" class="btn btn-primary">En savoir plus</a>--}}
                        </div>
                        <div class="col d-flex justify-content-center">
                            <img src="{{ asset('/assets/images/carousel/1.png') }}" class="d-block" alt="Logo Joie et Gym" height="396" width="396">
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
                            <h3>19 cours différents</h3>
                            <p>Répartis sur toute la semaine du Lundi au Samedi</p>
                            <a href="{{ route('planning') }}" class="btn btn-primary">Voir nos cours</a>
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
                <p class="lead">Joie et Gymnastique au Val d'Yerres est une Association sans but lucratif affiliée à la Fédération Française de Gymnastique Volontaire<br>
                Depuis 50 ans, elle propose des séances d'activités physiques variées, accessibles à tous les âges de la vie à partir de 16 ans révolus.</p>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <img src="{{ asset('/assets/images/Logo_FFEPGV_420x420.png') }}" class="d-block mx-auto" alt="Logo FFEPGV" height="'420'" width="420">
            </div>
        </div>
        <div class="row align-items-center justify-content-center text-center mt-5">
            <p><strong>Yoga, Gym Forme, Aquagym, Pilate, Stretching, Dance Move, Abdo-fessiers, Étirements, etc...</strong></p>
            <p>Notre programme offre plus de 45 heures de cours par semaine à prix attractif.<br>
            Du lundi au samedi midi durant l'année scolaire, en journée, mais également en soirée, pour répondre aux besoins de celles et ceux qui travaillent, vous pouvez garder la forme grâce au sport.</p>
            <p>10 Animateurs proposent à nos 350 adhérents. Résidant ou non dans le Val d'Yerres, des cours variés, correspondants aux attentes de chacun, dans une ambiance chaleureuse.</p>
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
            <p class="text-center lead"><strong>Les municipalités d'Epinay-sous-Sénart, Boussy-Saint-Antoine et Varennes-Jarcy, nous aident et mettent des salles à notre disposition :</strong></p>
        </div>
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/La_Ferme_Boussy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">La Ferme<br>
                            Boussy-Saint-Antoine</h5>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Gymnase_Cosec_Boussy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Le gymnase COSEC<br>
                            Boussy-Saint-Antoine</h5>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Sénart_Club_Epinay.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">La salle du Sénart-Club<br>
                            Epinay-Sous-Sénart</h5>
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
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Mairie_Varennes.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Salle à la Mairie<br>
                            Varennes-Jarcy</h5>
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
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Piscine_Brunoy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">La Piscine Yves Moreau<br>
                            Brunoy</h5>
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
