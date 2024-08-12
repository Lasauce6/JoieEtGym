@extends('main')

@section('title', 'Inscription')

@section('content')
    <div class="container mt-5">
        <div class="position-relative mx-auto">
            <div class="mx-auto">
                <div class="d-flex flex-column justify-content-start">
                    <h1 class="mb-4">
                        <strong>Inscription</strong>
                    </h1>
                    <p class="mt-2 text-muted">
                        Rejoignez-nous dès maintenant !<br>
                        Les inscriptions peuvent se faire tout au long de l'année
                    </p>
                    <p class="mt-4 text-muted text-center fs-6">
                        (Les inscriptions en ligne ne sont pas disponibles pour le moment).<br>
                        Vous pouvez télécharger le bulletin d'inscription et le questionnaire de santé.
                    </p>
                    <div class="embed-responsive mx-5">
                        <iframe id="pdfFrame1" class="embed-responsive-item w-100" src="{{ asset('assets/pdf/Bulletin-inscription-2024-2025.pdf') }}"></iframe>
                    </div>
                    <p class="mt-4 text-muted text-center fs-6">
                        Questionnaire de santé <a target="_blank" href="{{ asset('assets/pdf/Questionnaire-de-santé-mineurs-2024-2025.pdf') }}">(pour les mineurs (16 à 18 ans) un questionnaire de santé spécifique est à remplir)</a>
                    </p>
                    <div class="embed-responsive mx-5">
                        <iframe id="pdfFrame2" class="embed-responsive-item w-100" src="{{ asset('assets/pdf/Questionnaire-de-santé-majeur-2024-2025.pdf') }}"></iframe>
                    </div>
                    <p class="mt-4 text-muted text-center fs-6">
                        Planning des cours
                    </p>
                    <div class="embed-responsive mx-5">
                        <iframe id="pdfFrame2" class="embed-responsive-item w-100" src="{{ asset('assets/pdf/planning2024-2025.pdf') }}"></iframe>
                    </div>
                    <p class="mt-4 text-muted text-center fs-6">
                        Dépliant d'informations
                    </p>
                    <div class="embed-responsive mx-5">
                        <iframe id="pdfFrame2" class="embed-responsive-item w-100" src="{{ asset('assets/pdf/couvtripti23246.pdf') }}"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
