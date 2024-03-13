<!-- Footer -->
<footer class="text-center border-top mt-5">
    <div class="container">

        <section class="col mt-3 mx-5">
            <div class="row">
                <div class="col">
                    <a href="{{ route('index') }}">Accueil</a>
                </div>
                <div class="col">
                    <a @if(auth()->user() && auth()->user()->isAdmin()) href="/admin" @else href="{{ route('login') }}" @endif>Administration</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="{{ route('news') }}">Actualités</a>
                </div>
                <div class="col">
                    <a href="{{ route('legals') }}">Mentions légales</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="{{ route('planning') }}">Le planning</a>
                </div>
                <div class="col">
                    <a href="{{ asset('/assets/pdf/ANNEXE-1-Résumé-garanties-MAIF-23-24.pdf') }}">Assurance MAIF</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="{{ route('inscription') }}">Nous rejoindre</a>
                </div>
                <div class="col">
                    <a href="{{ asset('/assets/pdf/Assurance-IA-Sports2023-06-16-IJ-n°169-CLUBS-1.pdf') }}">Assurance complémentaire IA Sports</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                </div>
                <div class="col">
                    <a href="{{ asset('/assets/pdf/CR-AG-du-25nov2023.pdf') }}">Compte rendu AG</a>
                </div>
            </div>
        </section>

        <section class="mb-3 mt-3">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <p>
                        N'hésitez pas à nous contacter par courriel : <a href="mailto:joieetgym@gmail.com">joieetgym@gmail.com</a>
                        ou par téléphone : <a href="tel:+33160471929">01 60 47 19 29</a> / <a href="tel:+33145987795">01 45 98 77 95</a>, uniquement du lundi au vendredi de 14h à 17h.
                    </p>
                </div>
            </div>
        </section>


        <section class="text-center mb-3">
            <a href="https://www.facebook.com/Joie.et.Gym" target="_blank" class="me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
{{--            <a href="" class="me-4">--}}
{{--                <i class="fab fa-twitter"></i>--}}
{{--            </a>--}}
{{--            <a href="" class="text-white me-4">--}}
{{--                <i class="fab fa-google"></i>--}}
{{--            </a>--}}
{{--            <a href="" class="text-white me-4">--}}
{{--                <i class="fab fa-instagram"></i>--}}
{{--            </a>--}}
{{--            <a href="" class="text-white me-4">--}}
{{--                <i class="fab fa-linkedin"></i>--}}
{{--            </a>--}}
{{--            <a href="" class="text-white me-4">--}}
{{--                <i class="fab fa-github"></i>--}}
{{--            </a>--}}
        </section>

    </div>

    <div
        class="text-center p-4"
        style="background-color: rgba(0, 0, 0, 0.05);"
    >

        Site réalisé par <a href="https://raphaelbaticle.fr/" target="_blank">Raphaël Baticle</a> -
        © 2023 Copyright : Joie et Gymnastique
    </div>
</footer>
<!-- Footer -->
