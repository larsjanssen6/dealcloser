@extends('layout.app')
@section('content')

    @component('layout/hero')
        DASHBOARD
    @endcomponent

    <div class="container">
        @component('layout/header')
            Persoonlijk dashboard voor {{ Auth::user()->fullName }}
        @endcomponent

        <div class="columns">
            <div class="column is-one-quarter">
                @component('layout/card',
                    [
                        'labels' => ['Totaal, 10'],
                        'header' => 'November 17, 2016',
                        'footer' => 'Hier ziet u alle projecten.',
                        'meta'   => 'card-meta-blue'
                    ])

                    <a href="#">Projecten</a>
                @endcomponent
            </div>

            <div class="column is-one-quarter">
                @component('layout/card',
                    [
                        'labels' => ['Totaal, 10'],
                        'header' => 'November 17, 2016',
                        'footer' => 'Hier ziet u alle opportunities.',
                        'meta'   => 'card-meta-blue'
                    ])

                    <a href="#">Opportunities</a>
                @endcomponent
            </div>

            <div class="column is-one-quarter">
                @component('layout/card',
                    [
                        'labels' => [sprintf('Totaal, %s', $relations_total)],
                        'header' => isset($relations_latest) ? $relations_latest->created_at->diffForHumans() : 'nvt',
                        'footer' => 'Hier ziet u alle relaties.',
                        'meta'   => 'card-meta-blue'
                    ])

                    <a href="{{ route('relations') }}">Relaties</a>

                    @can('see-graphs')
                        <pie-chart  :data="{{ json_encode([
                                        $relations_total_last_month,
                                        $relations_total_current_month
                                    ]) }}"
                                    :labels="{{ json_encode([
                                            Date::now()->subMonth()->format('F'),
                                            Date::now()->format('F')
                                        ]) }}"
                                    :label="'Nieuwe relaties'"
                                    :background="'rgba(253, 228, 40, 0.6)'"
                                    :border="'rgba(253, 228, 40, 1)'">
                        </pie-chart>
                    @endcan
                @endcomponent
            </div>

            <div class="column is-one-quarter">
                @component('layout/card',
                    [
                        'labels' => [sprintf('Totaal, %s', $products_total)],
                        'header' => isset($products_latest) ? $products_latest->created_at->diffForHumans() : 'nvt',
                        'footer' => 'Hier ziet u alle producten.',
                        'meta'   => 'card-meta-blue'
                    ])

                    <a href="{{ route('products') }}">Producten</a>

                    @can('see-graphs')
                        <bar-chart  :data="{{ json_encode([
                                        $products_purchase,
                                        $products_price,
                                        $products_revenue,
                                        $products_gross_margin
                                    ]) }}"
                                    :labels="{{ json_encode([
                                        "Inkoop",
                                        "Verkoop",
                                        "Omzet",
                                        "Bruto"
                                    ]) }}"
                                    :width="800"
                                    :height="600"
                                    :money="true"
                                    :label="'Producten totaal'"
                                    :background="'rgba(253, 228, 40, 0.6)'"
                                    :border="'rgba(253, 228, 40, 1)'">
                        </bar-chart>
                    @endcan
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
                        'labels' => [sprintf('Totaal, %s', $users_total)],
                        'header' => $users_latest->created_at->diffForHumans(),
                        'footer' => 'Hier ziet u alle gebruikers van Dealcloser.',
                        'meta'   => 'card-meta-yellow'
                    ])

                    <a href="{{ route('users') }}">Gebruikers</a>


                @endcomponent
            </div>

            <div class="column is-half">
                @component('layout/card',
                    [
                        'labels' => ['Voor ' . Auth::user()->fullName],
                        'header' => 'November 17, 2016',
                        'footer' => 'Bekijk hier uw instellingen.',
                        'meta'   => 'card-meta-yellow'
                    ])

                    <a href="{{ route('settings.profile') }}">Instellingen</a>
                @endcomponent
            </div>
        </div>
    </div>
@endsection