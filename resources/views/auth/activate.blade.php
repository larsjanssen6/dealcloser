@extends('layout.app')
@section('content')

    @component('layout/hero')
        Activeer account
    @endcomponent

    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                @component('layout/panel')
                    <p>Activeer account</p>

                    @slot('body')
                        <form method="POST" class="form-horizontal" role="form" action="{{ route('register.activate', $token) }}">
                            {{ csrf_field() }}

                            @component('layout/input', [
                                    'name' => 'password',
                                    'label' => 'Wachtwoord',
                                    'type' => 'password'
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'password_confirmation',
                                    'label' => 'Bevestig wachtwoord',
                                    'type' => 'password'
                                ])
                            @endcomponent

                            <div class="field is-grouped is-centered">
                                <div class="control">
                                    <button id="submit" class="button is-primary">
                                        Activeer
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection