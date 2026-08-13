@extends('main')

@section('title', 'Inscription')

@php
use App\Enums\DocumentType;
@endphp

@section('content')
    <div class="container mt-5">
        <div class="position-relative mx-auto">
            <div class="mx-auto">
                <div class="d-flex flex-column justify-content-start">
                    <h1 class="mb-4">
                        <strong>Inscription</strong>
                    </h1>
                    <p class="mt-2 text-muted">
                        A partir du 24 août {{ date('Y') }} <br> <br>
                        Les inscriptions peuvent se faire toute l'année et uniquement via le site Helloasso. <br>
                        Le lien sera activé à partir du 1er Septembre <br>
                        <a href="https://www.helloasso.com/associations/joie-et-gymnastique-au-val-d-yerres/adhesions/bulletin-d-inscription-2026-2027-1" target="_blank">Lien pour s'inscrire</a>

                        <br> <br>
                        Au moment de votre adhésion, vous devez lire attentivement le questionnaire de santé. <br>
                        En cas de réponse positive à une ou plusieurs questions, vous devrez nous transmettre un certificat médical de moins de 6 mois <br> <br>
                        Si vous avez répondu à toutes les questions par la négative, il n'est pas nécessaire de transmettre l'attestation à l'association.
                    </p>
                    @if(isset($documents[DocumentType::Planning->value]))
                        <p class="mt-4 text-muted text-center fs-6">
                            Planning des cours
                        </p>
                        <div class="embed-responsive mx-5">
                            <iframe id="pdfFrame2" class="embed-responsive-item w-100" src="{{ Storage::url($documents[DocumentType::Planning->value]) }}"></iframe>
                        </div>
                    @endif
                    @if(isset($documents[DocumentType::Depliant->value]))
                    <p class="mt-4 text-muted text-center fs-6">
                        Dépliant d'informations
                    </p>
                    <div class="embed-responsive mx-5">
                        <iframe id="pdfFrame2" class="embed-responsive-item w-100" src="{{ Storage::url($documents[DocumentType::Depliant->value]) }}"></iframe>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
