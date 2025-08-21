@extends('main')

@section('title', 'Tarifs')

@section('content')
    <div class="container mt-5">
        <div class="position-relative mx-auto">
            <div class="mx-auto">
                <div class="d-flex flex-column justify-content-start">
                    <h1 class="mb-4">
                        <strong>Tarifs</strong>
                    </h1>
                    <div class="embed-responsive mx-5">
                        <iframe id="pdfFrame1" class="embed-responsive-item w-100" src="{{ asset('assets/pdf/TARIFS-2025-2026.pdf') }}"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
