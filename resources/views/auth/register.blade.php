@extends('layout.app')
@section('content')

    @component('layout/hero')
        REGISTREER GEBRUIKER
    @endcomponent

    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                @component('layout/panel')
                    <p>Registreer gebruiker</p>

                    @slot('body')
                        <form method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            @component('layout/input', [
                                    'name' => 'name',
                                    'label' => 'Voornaam',
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'preposition',
                                    'label' => 'Tussenvoegsel',
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'last_name',
                                    'label' => 'Achternaam',
                                ])
                            @endcomponent

                            @component('layout/input', [
                                     'name' => 'email',
                                     'label' => 'Email',
                                     'type' => 'email'
                                 ])
                            @endcomponent

                            @component('layout/input', [
                                     'name' => 'function',
                                     'label' => 'Functie',
                                 ])
                            @endcomponent

                            @component('layout/dropdown', [
                                   'name' => 'department_id',
                                   'label' => 'Afdeling',
                                   'array' => $departments,
                                   'value' => 'id',
                                   'option' => 'name',
                                   'selected' => old('department_id')
                               ])
                            @endcomponent

                            @component('layout/dropdown', [
                                   'name' => 'role',
                                   'label' => 'Role',
                                   'array' => $roles,
                                   'value' => 'name',
                                   'option' => 'name',
                                   'selected' => old('role')
                               ])
                            @endcomponent

                            <div class="field is-grouped is-centered">
                                <div class="control">
                                    <button id="submit" class="button is-primary">
                                        Registreer
                                    </button>
                                </div>

                                <div class="control">
                                    <a href="{{ route('users') }}">Annuleer</a>
                                </div>
                            </div>
                        </form>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection