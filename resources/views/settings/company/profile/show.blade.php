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
                            Update bedrijfsprofiel
                        </h2>

                        <form method="POST">
                            {{ csrf_field() }}

                            <input name="_method" type="hidden" value="PATCH">

                            @component('layout/input', [
                                    'name' => 'name',
                                    'label' => 'Naam',
                                    'value' => settings()->name,
                                    'required' => false
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'email',
                                    'label' => 'Email',
                                    'type' => 'email',
                                    'value' => settings()->email,
                                    'required' => false
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'phone',
                                    'label' => 'Telefoon',
                                    'value' => settings()->phone,
                                    'required' => false
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'website',
                                    'label' => 'Website',
                                    'value' => settings()->website,
                                    'required' => false
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'description',
                                    'label' => 'Omschrijving',
                                    'value' => settings()->description,
                                    'required' => false
                                ])
                            @endcomponent

                            <div class="control">
                                <button id="submit" type="submit" class="button is-primary">
                                    Update profiel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection