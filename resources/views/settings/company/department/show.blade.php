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
                            Afdelingen
                        </h2>

                        <departments :prp-departments="{{ json_encode($departments) }}" v-cloak></departments>

                        <div class="column is-6">
                            <form method="POST"
                                  class="form-horizontal"
                                  role="form"
                                  action="{{ route('settings.company.department') }}">

                                {{ csrf_field() }}

                                <div class="control">
                                    <label for="name" class="label">Naam:</label>

                                    <input id="name"
                                           name="name"
                                           type="text"
                                           class="input {{ $errors->has('name') ? ' is-danger' : '' }}"
                                           placeholder="Typ hier de afdelingsnaam die u wilt toevoegen"
                                           required
                                           autofocus>

                                    @if ($errors->has('name'))
                                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>

                                <div class="control">
                                    <button id="submit" type="submit" class="button is-primary is-outlined">
                                        Maak afdeling
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection