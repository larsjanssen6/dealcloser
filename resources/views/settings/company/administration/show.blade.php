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
                            Update bedrijfsadministratie
                        </h2>

                        <form method="POST">
                            {{ csrf_field() }}

                            <input name="_method" type="hidden" value="PATCH">

                            <div class="control">
                                <label for="kvk" class="label">Kvk:</label>

                                <input id="kvk"
                                       name="kvk"
                                       type="text"
                                       value="{{ settings()->kvk }}"
                                       class="input {{ $errors->has('kvk') ? ' is-danger' : '' }}"
                                       autofocus>

                                @if ($errors->has('kvk'))
                                    <p class="help is-danger">{{ $errors->first('kvk') }}</p>
                                @endif
                            </div>

                            <div class="control">
                                <label for="btw" class="label">Btw:</label>

                                <input id="btw"
                                       name="btw"
                                       type="text"
                                       value="{{ settings()->btw }}"
                                       class="input {{ $errors->has('btw') ? ' is-danger' : '' }}">

                                @if ($errors->has('btw'))
                                    <p class="help is-danger">{{ $errors->first('btw') }}</p>
                                @endif
                            </div>

                            <div class="control">
                                <button type="submit" class="button is-primary is-outlined">
                                    Update administratie
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection