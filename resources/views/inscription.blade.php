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
