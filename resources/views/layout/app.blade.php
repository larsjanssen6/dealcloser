<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DealCloser</title>

    <!-- Css -->
    <link href="{{ mix('/css/bulma.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/packages.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
    <body>
        <div id="app">
            <nav class="nav has-shadow">
                <div class="container">
                    <div class="nav-left">
                        <a href="/" class="nav-item">
                            <strong>DEALCLOSER</strong>
                        </a>
                    </div>

                    <span class="nav-toggle">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>

                    <div class="nav-right nav-menu">
                        @if(Auth::guest())
                            <a href="/" class="nav-item is-tab {{ setActive('/') }}">
                                <i class="fa fa-sign-in" aria-hidden="true"></i> &nbsp;
                                Login
                            </a>

                            <a href="{{ route('info.info') }}" class="nav-item is-tab {{ setActive('info') }}">
                                <i class="fa fa-info" aria-hidden="true"></i> &nbsp;
                                Info
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="nav-item is-tab {{ setActive('dashboard') }}">
                                Dashboard
                            </a>

                            <a href="{{ route('dashboard') }}" class="nav-item is-tab">
                                Projecten
                            </a>

                            <a href="{{ route('users') }}" class="nav-item is-tab {{ setActive('gebruikers') }}">
                                Gebruikers
                            </a>

                            <a href="{{ route('logout') }}" class="nav-item is-tab">
                                <i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp;
                                Uitloggen
                            </a>

                            <a href="{{ route('settings.profile') }}"
                               class="nav-item is-tab {{ setActive('instellingen/profiel') }}">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </nav>

            @yield('content')

            <footer class="footer">
                <div class="container">
                    <div class="content has-text-centered">
                        <p>
                            <strong>DealCloser</strong> licentie
                            <a href="{{ settings()->website ?? '' }}">{{ settings()->name ?? 'bedrijf' }}</a> - ©
                            <small> {{ date("Y") }}</small>
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        @if(Session::has('status'))
            <div id="is-popUp" class="notification is-popUp slideUp {!! Session::has('class') ? session('class') : '' !!}">
                <p>
                    {!! session('status')  !!}
                </p>
            </div>
        @endif

        <script src={{ mix('/js/app.js') }}></script>
    </body>
</html>
