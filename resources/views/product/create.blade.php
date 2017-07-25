@extends('layout.app')
@section('content')

    @component('layout/hero')
        REGISTREER PRODUCT
    @endcomponent

    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                @component('layout/panel')
                    <p>Registreer product</p>

                    @slot('body')
                        <form method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            @component('layout/input', [
                                   'name' => 'name',
                                   'label' => 'Product naam'
                               ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'description',
                                    'label' => 'Omschrijving'
                                 ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'price',
                                    'label' => 'Verkoopprijs',
                                    'type' => 'number'
                                 ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'purchase',
                                    'label' => 'Inkoopprijs',
                                    'type' => 'number'
                                 ])
                            @endcomponent

                            @component('layout/input', [
                                   'name' => 'amount',
                                   'label' => 'Aantal',
                                   'type' => 'number'
                                ])
                            @endcomponent

                            <div class="field is-grouped is-centered">
                                <div class="control">
                                    <button id="submit" class="button is-primary">
                                        Maak
                                    </button>
                                </div>

                                <div class="control">
                                    <a href="{{ route('products') }}">Annuleer</a>
                                </div>
                            </div>
                        </form>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection