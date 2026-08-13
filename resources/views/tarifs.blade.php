@extends('main')

@section('title', 'Tarifs')

@php
use App\Enums\ImageType;
@endphp

@section('content')
    <div class="container mt-5">
        <div class="position-relative mx-auto">
            <div class="mx-auto">
                <div class="d-flex flex-column justify-content-start">
                    <h1 class="mb-4">
                        <strong>Tarifs</strong>
                    </h1>
                    @if(@isset($images[ImageType::Tarifs->value]))
                        <div class="text-center">
                            <img src="{{ Storage::url($images[ImageType::Tarifs->value]) }}" alt="tarifs" class="img-fluid">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
