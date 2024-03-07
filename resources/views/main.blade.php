<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="{{ asset('/assets/css/custom.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/logob.png') }}">
    <script src="https://kit.fontawesome.com/208dc95b1d.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="wrapper">
        <header>
            @include('partials.header')
        </header>
        @yield('content')

        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="grey" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16" onclick="scrollToTop()" id="toTop">
            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
        </svg>
    </div>


    @include('partials.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        let t1 = 0;
        window.onscroll = scroll1;

        function scroll1() {
            const toTop = document.getElementById('toTop');
            window.scrollY > 500 ? toTop.style.display = 'Block' : toTop.style.display = 'none';
        }

        function scrollToTop() {
            window.scrollTo({top: 0, behaviour: 'smooth'});
        }
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YPRDGGFWD9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-YPRDGGFWD9');
    </script>
    @yield('scripts')
</body>
</html>
