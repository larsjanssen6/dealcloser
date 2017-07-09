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

                            @component('layout/input', [
                                    'name' => 'kvk',
                                    'label' => 'Kvk',
                                    'value' => settings()->kvk,
                                    'required' => false
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'btw',
                                    'label' => 'Btw',
                                    'value' => settings()->btw,
                                    'required' => false
                                ])
                            @endcomponent

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