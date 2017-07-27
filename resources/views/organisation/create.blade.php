@extends('layout.app')
@section('content')

    @component('layout/hero')
        REGISTREER ORGANISATIE
    @endcomponent

    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                @component('layout/panel')
                    <p>Registreer organisatie</p>

                    @slot('body')
                        <form method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            @component('layout/input', [
                                   'name' => 'name',
                                   'label' => 'Organisatie naam'
                               ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'account_manager',
                                    'label' => 'Account Manager'
                                 ])
                            @endcomponent

                            @component('layout/dropdown', [
                                    'name' => 'category_id',
                                    'label' => 'Bedrijfscategorie',
                                    'array' => $categories,
                                    'value' => 'id',
                                    'option' => 'name',
                                    'selected' => old('category_id')
                                ])
                            @endcomponent

                            <country-state></country-state>

                            @if ($errors->has('state_code'))
                                <p class="help is-danger">{{ $errors->first('state_code') }}</p>
                            @endif

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
                                    'name' => 'website',
                                    'label' => 'Website',
                                    'required' => false
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'linkedin',
                                    'label' => 'LinkedIn',
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
                                    <a href="{{ route('organisations') }}">Annuleer</a>
                                </div>
                            </div>
                        </form>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection