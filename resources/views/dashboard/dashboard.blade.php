@extends('layout.app')
@section('content')

    @component('layout/hero')
        DASHBOARD
    @endcomponent

    <div class="container">
        @component('layout/header')
            Begin Hier
        @endcomponent

        <div class="columns">
            <div class="column is-one-quarter">
                @component('layout/card',
                    [
                        'label' => 'Totaal, 10',
                        'header' => 'November 17, 2016',
                        'footer' => 'Hier ziet u alle projecten.',
                        'meta' => 'card-meta-blue'
                    ])

                    <a href="#">Projecten</a>
                @endcomponent
            </div>

            <div class="column is-one-quarter">
                @component('layout/card',
                    [
                        'label' => 'Totaal, 10',
                        'header' => 'November 17, 2016',
                        'footer' => 'Hier ziet u alle opportunities.',
                        'meta' => 'card-meta-blue'
                    ])

                    <a href="#">Opportunities</a>
                @endcomponent
            </div>

            <div class="column is-one-quarter">
                @component('layout/card',
                    [
                        'label' =>  sprintf('Totaal, %s', $total_relations),
                        'header' => $relations_latest->diffForHumans(),
                        'footer' => 'Hier ziet u alle relaties.',
                        'meta' => 'card-meta-blue'
                    ])

                    <a href="{{ route('relations') }}">Relaties</a>
                @endcomponent
            </div>

            <div class="column is-one-quarter">
                @component('layout/card',
                    [
                        'label' => 'Totaal, 10',
                        'header' => 'November 17, 2016',
                        'footer' => 'Hier ziet u alle producten.',
                        'meta' => 'card-meta-blue'
                    ])

                    <a href="{{ route('products') }}">Producten</a>
                @endcomponent
            </div>
        </div>

        @component('layout/header')
            Besturing Dealcloser
        @endcomponent

        <div class="columns">
            <div class="column is-half">
                @component('layout/card',
                    [
                        'label' => sprintf('Totaal, %s', $total_users),
                        'header' => $users_latest->diffForHumans(),
                        'footer' => 'Hier ziet u alle gebruikers van Dealcloser.',
                        'meta' => 'card-meta-yellow'
                    ])

                    <a href="{{ route('users') }}">Gebruikers</a>
                @endcomponent
            </div>

            <div class="column is-half">
                @component('layout/card',
                    [
                        'label' => 'Voor Lars Janssen',
                        'header' => 'November 17, 2016',
                        'footer' => 'Bekijk hier uw instellingen.',
                        'meta' => 'card-meta-yellow'
                    ])

                    <a href="{{ route('settings.profile') }}">Instellingen</a>
                @endcomponent
            </div>
        </div>
    </div>
@endsection