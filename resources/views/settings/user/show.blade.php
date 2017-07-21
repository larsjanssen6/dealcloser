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
                            Update profiel

                            @foreach($user->roles as $role)
                                <span class="tag is-success">{{ $role->name }}</span>
                            @endforeach
                        </h2>

                        <form method="POST" action="{{ route('settings.profile') }}">
                            {{ csrf_field() }}

                            <input name="_method" type="hidden" value="PATCH">

                            @component('layout/input', [
                                    'name' => 'name',
                                    'label' => 'Naam',
                                    'value' => $user->name
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'preposition',
                                    'label' => 'Tussenvoegsel',
                                    'value' => $user->preposition,
                                    'required' => false
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'last_name',
                                    'label' => 'Achternaam',
                                    'value' => $user->last_name
                                ])
                            @endcomponent

                            @component('layout/input', [
                                   'name' => 'email',
                                   'label' => 'Email',
                                   'value' => $user->email,
                                   'type' => 'email'
                               ])
                            @endcomponent

                            @component('layout/input', [
                                   'name' => 'password',
                                   'label' => 'Wachtwoord',
                                   'placeholder' => '**********',
                                   'required' => false,
                                   'type' => 'password'
                               ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'password_confirmation',
                                    'label' => 'Bevestig wachtwoord',
                                    'placeholder' => '**********',
                                    'required' => false,
                                    'type' => 'password'
                                ])
                            @endcomponent

                            @component('layout/input', [
                                    'name' => 'function',
                                    'label' => 'Functie',
                                    'value' => $user->function
                                ])
                            @endcomponent

                            @component('layout/dropdown', [
                                   'name' => 'department_id',
                                   'label' => 'Afdeling',
                                   'collection' => $departments,
                                   'value' => 'id',
                                   'option' => 'name',
                                   'selected' => $user->department_id
                               ])
                            @endcomponent

                            <div class="control">
                                <button type="submit" class="button is-primary is-outlined">
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