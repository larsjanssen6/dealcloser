<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DealCloser</title>

    <!-- Js (We use Turbolinks) -->

    <script src={{ mix('/js/app.js') }}></script>

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
            <div class="bar"></div>
            <nav class="navbar">
                <div class="navbar-brand">
                    <a class="navbar-item" href="/">
                        <strong>DEALCLOSER</strong>
                    </a>

                    <div class="navbar-burger burger" data-target="dealCloserNav">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

                <div id="dealCloserNav" class="navbar-menu">
                    <div class="navbar-end">
                        @if(Auth::guest())
                            <a href="/" class="navbar-item">
                                <i class="fa fa-sign-in" aria-hidden="true"></i> &nbsp;
                                Login
                            </a>

                            <a href="{{ route('info.info') }}" class="navbar-item">
                                <i class="fa fa-info" aria-hidden="true"></i> &nbsp;
                                Info
                            </a>
                        @else
                            <a href="/" class="navbar-item">
                                Dashboard
                            </a>

                            <div class="navbar-item has-dropdown is-hoverable">
                                <a href="#" class="navbar-link">
                                    Overzicht
                                </a>

                                <div class="navbar-dropdown">
                                    <a href="#" class="navbar-item">
                                        Projecten
                                    </a>

                                    <a href="#" class="navbar-item">
                                        Opportunities
                                    </a>

                                    <a href="{{ route('relations') }}" class="navbar-item">
                                        Relaties
                                    </a>

                                    <a href="{{ route('products') }}" class="navbar-item">
                                        Producten
                                    </a>

                                    <hr class="navbar-divider">

                                    <a href="{{ route('users') }}" class="navbar-item is-active">
                                        Gebruikers
                                    </a>

                                    <a href="{{ route('settings.profile') }}" class="navbar-item">
                                        Instellingen
                                    </a>

                                    <hr class="navbar-divider">

                                    <div class="navbar-item">
                                        <div>Versie <p class="has-text-info">1.0</p></div>
                                    </div>
                                </div>
                            </div>

                            <div class="navbar-item">
                                <div class="field">
                                    <p class="control">
                                        <a href="{{ route('logout') }}" class="button is-primary">
                                            <span class="icon">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            </span>

                                            <span>Uitloggen</span>
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('settings.profile') }}" class="navbar-item">
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
    </body>
</html>
