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
                            Rollen
                        </h2>

                        <roles :prp-roles="{{ json_encode($roles) }}" v-cloak></roles>

                        <div class="column is-5">
                            <form method="POST"
                                  class="form-horizontal"
                                  role="form"
                                  action="{{ route('settings.rights.role') }}">

                                {{ csrf_field() }}

                                @component('layout/input', [
                                       'name' => 'name',
                                       'label' => 'Naam',
                                       'placeholder' => 'Typ hier de naam die u wilt toevoegen'
                                   ])
                                @endcomponent

                                <div class="field is-grouped is-centered">
                                    <div class="control">
                                        <button id="submit" type="submit" class="button is-primary">
                                            Maak rol
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection