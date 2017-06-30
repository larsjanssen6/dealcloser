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

                            <div class="field">
                                <label for="password" class="label">Wachtwoord</label>

                                <p class="control has-icons-left {{ $errors->has('password') ? ' has-icons-right' : '' }}">
                                    <input id="password"
                                           name="password"
                                           type="password"
                                           class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
                                           required>

                                    <span class="icon is-small is-left">
                                        <i class="fa fa-lock"></i>
                                    </span>

                                    @if ($errors->has('password'))
                                        <span class="icon is-small is-right">
                                            <i class="fa fa-warning"></i>
                                        </span>
                                    @endif
                                </p>

                                @if ($errors->has('password'))
                                    <p class="help is-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>

                            <div class="field">
                                <label for="password_confirmation" class="label">Bevestig wachtwoord</label>

                                <p class="control has-icons-left {{ $errors->has('password_confirmation') ? ' has-icons-right' : '' }}">
                                    <input id="password_confirmation"
                                           name="password_confirmation"
                                           type="password"
                                           class="input {{ $errors->has('password_confirmation') ? ' is-danger' : '' }}"
                                           required>

                                    <span class="icon is-small is-left">
                                        <i class="fa fa-lock"></i>
                                    </span>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="icon is-small is-right">
                                            <i class="fa fa-warning"></i>
                                        </span>
                                    @endif
                                </p>

                                @if ($errors->has('password_confirmation'))
                                    <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                                @endif
                            </div>

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