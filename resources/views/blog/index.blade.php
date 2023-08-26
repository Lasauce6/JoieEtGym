@extends('main')

@php($title = 'Joie et Gym | ' . $seo['seo_title'])

@section('title', $title)

@section('content')
    <div class="container mt-5">
        <div class="position-relative mx-auto">
            <div class="mx-auto">
                <div class="d-flex flex-column justify-content-start">
                    <h1 class="font-weight-bold">
                        <strong> Les dernières actualités</strong>
                    </h1>
                    <p class="mt-2 text-muted">
                        Soyez au courant des dernières actualités de Joie et Gym.
                    </p>
                    <div class="category-list">
                        <a href="{{ route('news') }}">
                            <div class="{{ request()->is('news') ? 'category-item active' : 'category-item' }}">
                                Toutes les catégories
                            </div>
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('news.category', $cat->slug) }}">
                                <div class="category-item @if(isset($category) && isset($category->slug) && ($category->slug == $cat->slug)) active @endif">
                                    {{ $cat->name }}
                                </div>
                            </a>
                        @endforeach
                    </div>


                </div>
                <div class="row mx-auto mt-4">
                    <!-- Loop Through Posts Here -->
                    @foreach($posts as $post)
                        <article id="post-{{ $post->id }}" class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="{{ $post->link() }}">
                                    <img class="card-img-top" src="{{ $post->image() }}" alt="">
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="{{ $post->link() }}"><strong>{{ $post->title }}</strong></a>
                                    </h3>
                                    <p class="card-text">
                                        {!! substr(strip_tags($post->meta_description), 0, 200) !!} @if(strlen(strip_tags($post->meta_description)) > 200) {{ '...' }} @endif
                                    </p>
                                    <p class="text-muted small post-category">
                                        <a href="{{ route('news.category', $post->category->slug) }}" class="text-primary">
                                            {{ $post->category->name }}
                                        </a>
                                    </p>
                                </div>
                                <div class="card-footer bg-light d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="{{ asset('storage/' . $post->user->avatar) }}" alt="" style="width: 40px; height: 40px;">
                                    <div>
                                        <p class="mb-0 small font-weight-medium">
                                            Écrit par <strong>{{ $post->user->name }}</strong>
                                        </p>
                                        <p class="text-muted small">
                                            le <time datetime="{{ Carbon\Carbon::parse($post->published_date)->toIso8601String() }}">
                                                {{ Carbon\Carbon::parse($post->published_date)->locale('fr_FR')->isoFormat('LL') }}
                                            </time>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    <!-- End Post Loop Here -->
                </div>
            </div>
            <div class="d-flex justify-content-center my-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
