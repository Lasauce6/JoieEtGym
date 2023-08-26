@extends('main')

@section('title', 'Joie et Gym | Page introuvable')

@section('content')
    <div class="container-sm custom-container mt-5 px-4">
        <div class="position-relative mx-auto">
            <div class="mx-auto">
                <div class="d-flex flex-column justify-content-start text-center">
                    <div class=mt-3">
                        <h1 class="mb-4">
                            <strong>Page introuvable</strong>

                        </h1>
                        <span class="mt-2 text-muted">
                                La page que vous recherchez n'existe pas.
                            </span>
                        <img src="{{ asset('/assets/images/404-error.png') }}"  alt="Erreur 404" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
