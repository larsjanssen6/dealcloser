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

                            @component('layout/input', [
                                   'name' => 'users',
                                   'label' => 'Max aantal gebruikers',
                                   'value' => settings()->users,
                                   'type' => 'number',
                                   'required' => false
                               ])
                            @endcomponent

                            <div class="field">
                                <label for="active" class="label">Actief t/m:</label>

                                <div class="control">
                                    <date-picker prp-date="{{ json_encode(settings()->active) }}" prp-name="active"></date-picker>
                                </div>
                            </div>

                            @component('layout/input', [
                                   'name' => 'license',
                                   'label' => 'Licentie code',
                                   'value' => settings()->license,
                                   'required' => false
                               ])
                            @endcomponent

                            <div class="control">
                                <button class="button is-primary is-outlined">
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