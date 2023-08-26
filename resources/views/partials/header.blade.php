<nav class="navbar navbar-expand-md p-3 border-bottom" id="main-header">
    <div class="d-flex flex-wrap align-items-center justify-content-lg-start w-100">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" tabindex="-1" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" data-bs-target="#navbarNav"></span>
        </button>
        <a href="{{ route('index') }}" class="d-flex align-items-center mb-lg-0 text-white text-decoration-none" id="logo">
            <img src="{{ asset('/assets/images/logon.png') }}" width="80" height="80" alt="Logo Joie et Gym">
        </a>
        <div class="offcanvas offcanvas-start offcanvas-size-sm" data-bs-scroll="true" tabindex="-1" id="navbarNav">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'text-secondary' : 'text-dark' }}" href="{{ route('index') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('news') ? 'text-secondary' : 'text-dark' }}" href="{{ route('news') }}">Actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('planning') ? 'text-secondary' : 'text-dark' }}" href="{{ route('planning') }}">Le planning</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('inscription') ? 'text-secondary' : 'text-dark' }}" href="{{ route('inscription') }}">Nous rejoindre</a>
                    </li>
                </ul>
                <div id="header-right" class="d-flex justify-content-lg-end mt-3 mt-lg-0">
                    <ul class="navbar-nav">
                        @if(auth()->user())
{{--                            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('profile') }}">Profil</a></li>--}}
                            @if(auth()->user()->isAdmin())<li class="nav-item"><a href="/admin" class="nav-link text-dark">Administration</a></li> @endif
                            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('logout') }}">Déconnexion</a></li>
{{--                        @else--}}
{{--                            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('login') }}">Connexion</a></li>--}}
{{--                            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('register') }}">Inscription</a></li>--}}
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
