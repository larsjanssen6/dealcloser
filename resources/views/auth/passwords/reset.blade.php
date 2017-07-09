@extends('layout.app')
@section('content')

    @component('layout/hero') @endcomponent

    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                @component('layout/panel')
                    <p>Wachtwoord reset</p>

                    @slot('body')
                        <form method="POST" class="form-horizontal" role="form">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            @component('layout/input', [
                                    'name' => 'email',
                                    'label' => 'Email'
                                ])
                            @endcomponent

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
                                        Reset wachtwoord
                                    </button>
                                </div>

                                <div class="control">
                                    <a href="/">Annuleer</a>
                                </div>
                            </div>
                        </form>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection