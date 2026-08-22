@php
    use App\Enums\DocumentType;
    use Illuminate\Support\Facades\Storage;
@endphp

<!-- Footer -->
<footer class="text-center border-top mt-5">
    <div class="container">

        @php
            $footerLinks = [
                ['url' => route('index'), 'label' => 'Accueil'],
            ];

            if (Cache::get('route_toggle_cours', true)) {
                $footerLinks[] = ['url' => route('cours'), 'label' => 'Les cours'];
            }
            if (Cache::get('route_toggle_tarifs', true)) {
                $footerLinks[] = ['url' => route('tarifs'), 'label' => 'Tarifs'];
            }
            if (Cache::get('route_toggle_news', true)) {
                $footerLinks[] = ['url' => route('news'), 'label' => 'Actualités'];
            }
            if (Cache::get('route_toggle_planning', true)) {
                $footerLinks[] = ['url' => route('planning'), 'label' => 'Le planning'];
            }
            if (Cache::get('route_toggle_inscription', true)) {
                $footerLinks[] = ['url' => route('inscription'), 'label' => 'Nous rejoindre'];
            }

            $footerLinks[] = ['url' => (auth()->user() && auth()->user()->isAdmin()) ? '/admin' : route('login'), 'label' => 'Administration'];
            $footerLinks[] = ['url' => route('legals'), 'label' => 'Mentions légales'];

            if (isset($documents[DocumentType::AssuranceMaif->value])) {
                $footerLinks[] = ['url' => Storage::url($documents[DocumentType::AssuranceMaif->value]), 'label' => 'Assurance MAIF'];
            }
            if (isset($documents[DocumentType::AssuranceIaSports->value])) {
                $footerLinks[] = ['url' => Storage::url($documents[DocumentType::AssuranceIaSports->value]), 'label' => 'Assurance complémentaire IA Sports'];
            }
            if (isset($documents[DocumentType::CompteRenduAg->value])) {
                $footerLinks[] = ['url' => Storage::url($documents[DocumentType::CompteRenduAg->value]), 'label' => 'Compte rendu AG'];
            }
            if (isset($documents[DocumentType::QstMajeurs->value])) {
                $footerLinks[] = ['url' => Storage::url($documents[DocumentType::QstMajeurs->value]), 'label' => 'Questionnaire de santé (Majeurs)'];
            }
            if (isset($documents[DocumentType::QstMineurs->value])) {
                $footerLinks[] = ['url' => Storage::url($documents[DocumentType::QstMineurs->value]), 'label' => 'Questionnaire de santé (Mineurs)'];
            }

            $half = ceil(count($footerLinks) / 2);
            $columns = array_chunk($footerLinks, $half);
        @endphp

        <section class="col mt-3 mx-5">
            <div class="row">
                @foreach($columns as $column)
                    <div class="col">
                        <ul class="list-unstyled">
                            @foreach($column as $link)
                                <li>
                                    <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="mb-3 mt-3">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <p>
                        Vous pouvez nous contacter :
                    </p>
                    <ul class="list-unstyled">
                        <li class="mb-2">Par courriel : <a href="mailto:joieetgym@gmail.com">joieetgym@gmail.com</a></li>
                        <li class="mb-2">Par téléphone : <a href="tel:+33160471929">01 60 47 19 29</a> (du lundi au vendredi de 14h à 17h)</li>
                        <li class="mb-2">Par courrier : Mairie d'Epinay-sous-Sénart, 8 Rue Sainte Geneviève - 91860 Epinay-sous-Sénart</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="text-center mb-3">
            <a href="https://www.facebook.com/Joie.et.Gym" target="_blank" class="me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
        </section>

    </div>

    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        Site réalisé par <a href="https://raphaelbaticle.fr/" target="_blank">Raphaël Baticle</a> -
        © 2025 Copyright : Joie et Gymnastique
    </div>
</footer>
<!-- Footer -->
