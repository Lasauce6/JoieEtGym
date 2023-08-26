@extends('main')

@php($title = 'Joie et Gym | Post - ' . $post->title)

@section('title', $title)

@section('content')
    <div class="container-sm custom-container mt-5 px-4">
        <div class="position-relative">
            <div class="mx-auto">
                <div class="d-flex flex-column justify-content-start">
                    <a href="{{ route('news') }}" class="mb-5">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="16" width="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Retour aux actualités
                    </a>
                    <div class="mt-3">
                        <h1 class="mb-4">
                            <strong>{{ $post->title }}</strong>

                        </h1>
                        <span class="mt-2 text-muted">
                                Écrit le <time datetime="{{ Carbon\Carbon::parse($post->published_date)->toIso8601String() }}">
                                                {{ Carbon\Carbon::parse($post->published_date)->locale('fr_FR')->isoFormat('LL') }}
                                            </time>-
                                Dans la catégorie <a href="{{ route('news.category', $post->category->slug) }}" class="text-black" rel="category">{{ $post->category->name }}</a>
                            </span>
                    </div>
                    <div class="text-center mt-5">
                        <img class="img-fluid rounded" src="{{ $post->image() }}" alt="{{ $post->title }}" srcset="{{ $post->image() }}">
                    </div>
                    <div class="mx-auto mt-4 text-break post-body text-justify">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
