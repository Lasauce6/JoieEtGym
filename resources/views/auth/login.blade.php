@extends('main')

@section('title', 'Joie et Gym | Administration')

@section('content')
    <div class="container my-5">

        <h1 class="text-center">Login</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger mt-2" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <form method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" >
            </div>
            <button type="submit" class="btn btn-secondary">Se connecter</button>
        </form>
    </div>
@endsection
