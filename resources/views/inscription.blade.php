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
                        A partir du 1er septembre 2025 <br> <br>
                        Les inscriptions peuvent se faire toute l'année et uniquement via le site Helloasso. <br>
                        Le lien sera activé à partir du 1er Septembre <br>
                        <a href="https://www.helloasso.com/associations/joie-et-gymnastique-au-val-d-yerres/adhesions/bulletin-d-inscription-2025-2026-1" target="_blank">Lien pour s'inscrire</a> <br> <br>
                        Au moment de votre adhésion, vous devez lire attentivement le questionnaire de santé. <br>
                        En cas de réponse positive à une ou plusieurs questions, vous devrez nous transmettre un certificat médical de moins de 6 mois <br> <br>
                        Si vous avez répondu à toutes les questions par la négative, il n'est pas nécessaire de transmettre l'attestation à l'association.
                    </p>
                    <p class="mt-4 text-muted text-center fs-6">
                        Planning des cours
                    </p>
                    <div class="embed-responsive mx-5">
                        <iframe id="pdfFrame2" class="embed-responsive-item w-100" src="{{ asset('assets/pdf/planning2025-2026.pdf') }}"></iframe>
                    </div>
                    <p class="mt-4 text-muted text-center fs-6">
                        Dépliant d'informations
                    </p>
                    <div class="embed-responsive mx-5">
                        <iframe id="pdfFrame2" class="embed-responsive-item w-100" src="{{ asset('assets/pdf/depliant2025.pdf') }}"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
