@extends('layout.app')
@section('content')

    @component('layout/hero')
        Registreer relatie
    @endcomponent

    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                @component('layout/panel')
                    <p>Registreer relatie</p>

                    @slot('body')
                        <form method="POST" class="form-horizontal" role="form">
                            {{ csrf_field() }}

                            @component('layout/input', [
                                    'name' => 'account_manager',
                                    'label' => 'Account Manager'
                                 ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'organisation',
                                    'label' => 'Organisatie'
                                ])
                            @endcomponent

                            @component('layout/dropdown', [
                                    'name' => 'category_id',
                                    'label' => 'Bedrijfscategorie',
                                    'collection' => $categories,
                                    'value' => 'id',
                                    'option' => 'name'
                                ])
                            @endcomponent

                            <country-state :countries="{{json_encode($countries)}}"></country-state>

                            @component('layout/input', [
                                    'name' => 'street',
                                    'label' => 'Straat'
                                ])
                            @endcomponent

                            @component('layout/input', [
                                   'name' => 'house_number',
                                   'label' => 'Huisnummer'
                               ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'zip',
                                    'label' => 'Postcode'
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'town',
                                    'label' => 'Woonplaats'
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'sales_area',
                                    'label' => 'Verkoopgebied'
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'email',
                                    'label' => 'Email',
                                    'type' => 'email'
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'phone',
                                    'label' => 'Telefoon'
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'facebook',
                                    'label' => 'Facebook',
                                    'required' => false
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'whatsapp',
                                    'label' => 'Whatsapp',
                                    'required' => false
                                 ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'website',
                                    'label' => 'Website',
                                    'required' => false
                                ])
                            @endcomponent

                            <div class="field is-grouped is-centered">
                                <div class="control">
                                    <button id="submit" class="button is-primary">
                                        Maak
                                    </button>
                                </div>

                                <div class="control">
                                    <a href="{{ route('relations') }}">Annuleer</a>
                                </div>
                            </div>
                        </form>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection