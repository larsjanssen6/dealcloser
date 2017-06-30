@extends('layout.app')
@section('content')

    @component('layout/hero')
        INSTELLINGEN
    @endcomponent

    <div class="container">
        <div class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        @component('layout/menu/settings') @endcomponent
                    </div>

                    <div class="column is-faded is-9">
                        <h2 class="title is-3">
                            Update bedrijfsgebruik
                        </h2>

                        <form method="POST">
                            {{ csrf_field() }}

                            <input name="_method" type="hidden" value="PATCH">

                            <div class="control">
                                <label for="users" class="label">Max aantal gebruikers:</label>

                                <input id="users"
                                       name="users"
                                       type="number"
                                       value="{{ settings()->users }}"
                                       class="input {{ $errors->has('users') ? ' is-danger' : '' }}"
                                       autofocus>

                                @if ($errors->has('users'))
                                    <p class="help is-danger">{{ $errors->first('users') }}</p>
                                @endif
                            </div>

                            <div class="control">
                                <label for="active" class="label">Actief t/m:</label>

                                <date-picker :date="{{ json_encode(settings()->active) }}"></date-picker>

                                @if ($errors->has('active'))
                                    <p class="help is-danger">{{ $errors->first('active') }}</p>
                                @endif
                            </div>

                            <div class="control">
                                <label for="license" class="label">Licentie code:</label>

                                <input id="license"
                                       name="license"
                                       type="text"
                                       value="{{ settings()->license }}"
                                       class="input">

                                @if ($errors->has('license'))
                                    <p class="help is-danger">{{ $errors->first('license') }}</p>
                                @endif
                            </div>

                            <div class="control">
                                <button type="submit" class="button is-primary is-outlined">
                                    Update gebruik
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection