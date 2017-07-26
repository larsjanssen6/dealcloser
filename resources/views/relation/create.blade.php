@extends('layout.app')
@section('content')

    @component('layout/hero')
        REGISTREER RELATIE
    @endcomponent

    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                <form method="POST" class="form-horizontal" role="form">
                    {{ csrf_field() }}

                    @component('layout/card',
                        [
                            'header' => 'Algemeen',
                            'meta'   => 'card-meta-blue'
                        ])

                        @component('layout/input', [
                                  'name' => 'name',
                                  'label' => 'Naam'
                              ])
                        @endcomponent

                        @component('layout/input', [
                                'name' => 'preposition',
                                'label' => 'Tussenvoegsel',
                                'required' => false
                             ])
                        @endcomponent

                        @component('layout/input', [
                                'name' => 'last_name',
                                'label' => 'Achternaam'
                             ])
                        @endcomponent

                        @component('layout/input', [
                                'name' => 'initial',
                                'label' => 'Initialen',
                                'required' => false
                             ])
                        @endcomponent

                        @component('layout/input', [
                               'name' => 'phone',
                               'label' => 'Telefoon',
                               'type' => 'number',
                               'required' => false
                            ])
                        @endcomponent

                        @component('layout/input', [
                               'name' => 'linkedin',
                               'label' => 'Linkedin',
                               'required' => false
                            ])
                        @endcomponent

                        @component('layout/input', [
                               'name' => 'email',
                               'label' => 'Email',
                               'type' => 'email'
                            ])
                        @endcomponent

                        @component('layout/input', [
                               'name' => 'function',
                               'label' => 'Functie'
                            ])
                        @endcomponent

                        <div class="field">
                            <label for="date_of_birth" class="label">Geboortedatum</label>
                            <date-picker prp-name="date_of_birth" v-init:date="'{{ old('date_of_birth') }}'" :prp-time="false"></date-picker>

                            @if ($errors->has('date_of_birth'))
                                <p class="help is-danger">{{ $errors->first('date_of_birth') }}</p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="employee_since" class="label">Werknemer sinds</label>
                            <date-picker prp-name="employee_since" v-init:date="'{{ old('employee_since') }}'" :prp-time="false"></date-picker>

                            @if ($errors->has('employee_since'))
                                <p class="help is-danger">{{ $errors->first('employee_since') }}</p>
                            @endif
                        </div>

                        @component('layout/dropdown', [
                                'name' => 'gender',
                                'label' => 'Man/vrouw',
                                'array' => [
                                    ['id' => 0, 'name' => 'man'],
                                    ['id' => 1, 'name' => 'vrouw']
                                ],
                                'value' => 'id',
                                'option' => 'name',
                                'selected' => old('gender')
                            ])
                        @endcomponent

                        <div class="field">
                            <label for="organisations_working_at" class="label">Werkzaam bij</label>

                            @if(empty($organisations))
                                <p>
                                    Er zijn nog geen organisaties. Maak deze
                                    <a href="{{ route('organisations.create') }}">hier</a> aan.
                                </p>

                            @else
                                <div class="control">
                                    <multi-select prp-name="organisations_working_at"
                                                  :prp-options="{{ json_encode($organisations) }}"
                                                  prp-placeholder="Kies organisatie(s)">
                                    </multi-select>
                                </div>
                            @endif

                        </div>

                        <div class="field">
                            <label for="organisations_worked_at" class="label">Gewerkt bij</label>

                            @if(empty($organisations))
                                <p>
                                    Er zijn nog geen organisaties. Maak deze
                                    <a href="{{ route('organisations.create') }}">hier</a> aan.
                                </p>

                            @else
                                <div class="control">
                                    <multi-select prp-name="organisations_worked_at"
                                                  :prp-options="{{ json_encode($organisations) }}"
                                                  prp-placeholder="Kies organisatie(s)">
                                    </multi-select>
                                </div>
                            @endif
                        </div>

                        @component('layout/input', [
                              'name' => 'worked_at',
                              'label' => 'Werkzaam bij (anders)',
                              'required' => false
                           ])
                        @endcomponent
                    @endcomponent

                    @component('layout/card',
                        [
                            'header' => 'Onderhandelings profiel',
                            'meta'   => 'card-meta-blue'
                        ])

                        @component('layout/dropdown', [
                               'name' => 'role_id',
                               'label' => 'Rol',
                               'array' => $roles,
                               'value' => 'id',
                               'option' => 'name',
                               'selected' => old('role_id')
                            ])
                        @endcomponent

                        @component('layout/dropdown', [
                                'name' => 'character_id',
                                'label' => 'Karakter',
                                'array' => $characters,
                                'value' => 'id',
                                'option' => 'name',
                                'selected' => old('character_id')
                            ])
                        @endcomponent

                        @component('layout/dropdown', [
                               'name' => 'negotiation_profile_id',
                               'label' => 'Onderhandelingsprofiel',
                               'array' => $profiles,
                               'value' => 'id',
                               'option' => 'name',
                               'selected' => old('negotiation_profile_id')
                           ])
                        @endcomponent

                        @component('layout/dropdown', [
                               'name' => 'dmu_id',
                               'label' => 'Dmu (Decision Making Unit)',
                               'array' => $decision_making_units,
                               'value' => 'id',
                               'option' => 'name',
                               'selected' => old('dmu_id')
                           ])
                        @endcomponent

                        @component('layout/dropdown', [
                                'name' => 'problem_owner',
                                'label' => 'Probleem eigenaar',
                                'array' => [
                                   ['id' => 0, 'name' => 'Nee'],
                                   ['id' => 1, 'name' => 'Ja']
                                ],
                                'value' => 'id',
                                'option' => 'name',
                                'selected' => old('problem_owner')
                            ])
                        @endcomponent

                        <div class="field">
                            <label for="relations_internal" class="label">Wie kent deze relatie intern?</label>

                            @if(empty($relations))
                                <p>
                                    Er zijn nog geen relaties.
                                </p>
                            @else
                                <div class="control">
                                    <multi-select prp-name="relations_internal"
                                                  :prp-options="{{ json_encode($relations) }}"
                                                  prp-placeholder="Kies relatie(s)">
                                    </multi-select>
                                </div>
                            @endif

                            @if ($errors->has('relations_internal'))
                                <p class="help is-danger">{{ $errors->first('relations_internal') }}</p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="relations_external" class="label">Wie kent deze relatie extern?</label>

                            @if(empty($relations))
                                <p>
                                    Er zijn nog geen relaties.
                                </p>
                            @else
                                <div class="control">
                                    <multi-select prp-name="relations_external"
                                                  :prp-options="{{ json_encode($relations) }}"
                                                  prp-placeholder="Kies relatie(s)">
                                    </multi-select>
                                </div>
                            @endif

                            @if ($errors->has('relations_external'))
                                <p class="help is-danger">{{ $errors->first('relations_external') }}</p>
                            @endif
                        </div>

                        @component('layout/textfield', [
                                'name' => 'experience_with_us',
                                'label' => 'Ervaringen relatie met onze organisatie',
                                'placeholder' => 'Welke ervaringen heeft deze functionaris opgedaan met ons bedrijf, producten/diensten?'
                            ])
                        @endcomponent

                        @component('layout/textfield', [
                               'name' => 'track_record',
                               'label' => 'Track record onderhandelen',
                               'placeholder' => 'In welke onderhandeltrajecten zijn we deze functionaris ook tegen gekomen?'
                           ])
                        @endcomponent
                    @endcomponent

                    @component('layout/card',
                        [
                            'header' => 'Persoonlijk',
                            'meta'   => 'card-meta-blue'
                        ])

                        @component('layout/input', [
                              'name' => 'hobbies',
                              'label' => 'Hobbies',
                              'required' => false
                           ])
                        @endcomponent

                        @component('layout/dropdown', [
                                'name' => 'married',
                                'label' => 'Getrouwd/relatie',
                                'array' => [
                                    ['id' => 0, 'name' => 'Nee'],
                                    ['id' => 1, 'name' => 'Ja']
                                ],
                                'value' => 'id',
                                'option' => 'name',
                                'selected' => old('married')
                            ])
                        @endcomponent

                        @component('layout/dropdown', [
                                'name' => 'children',
                                'label' => 'Kinderen',
                                'array' => [
                                    ['id' => 0, 'name' => 'Nee'],
                                    ['id' => 1, 'name' => 'Ja']
                                ],
                                'value' => 'id',
                                'option' => 'name',
                                'selected' => old('children')
                            ])
                        @endcomponent

                        @component('layout/dropdown', [
                                'name' => 'o3',
                                'label' => 'Tonen in o3 ',
                                'array' => [
                                    ['id' => 0, 'name' => 'Nee'],
                                    ['id' => 1, 'name' => 'Ja']
                                ],
                                'value' => 'id',
                                'option' => 'name',
                                'selected' => old('o3')
                            ])
                        @endcomponent

                        @component('layout/dropdown', [
                                'name' => 'newsletter',
                                'label' => 'Ontvangt nieuwsbrief',
                                'array' => [
                                    ['id' => 0, 'name' => 'Nee'],
                                    ['id' => 1, 'name' => 'Ja']
                                ],
                                'value' => 'id',
                                'option' => 'name',
                                'selected' => old('newsletter')
                            ])
                        @endcomponent

                        @component('layout/dropdown', [
                                'name' => 'events',
                                'label' => 'Events',
                                'array' => [
                                   ['id' => 0, 'name' => 'Nee'],
                                   ['id' => 1, 'name' => 'Ja']
                                ],
                                'value' => 'id',
                                'option' => 'name',
                                'selected' => old('events')
                            ])
                        @endcomponent

                        @component('layout/dropdown', [
                                'name' => 'christmas_card',
                                'label' => 'Ontvangt kerstkaart',
                                'array' => [
                                    ['id' => 0, 'name' => 'Nee'],
                                    ['id' => 1, 'name' => 'Ja']
                                ],
                                'value' => 'id',
                                'option' => 'name',
                                'selected' => old('christmas_card')
                            ])
                        @endcomponent

                        @component('layout/dropdown', [
                                'name' => 'send_email',
                                'label' => 'Ontvangt email',
                                'array' => [
                                    ['id' => 0, 'name' => 'Nee'],
                                    ['id' => 1, 'name' => 'Ja']
                                ],
                                'value' => 'id',
                                'option' => 'name',
                                'selected' => old('send_email')
                            ])
                        @endcomponent
                    @endcomponent

                    @component('layout/card',
                       [
                           'meta'   => 'card-meta-blue'
                       ])
                        <div class="field is-grouped is-centered">
                            <div class="control">
                                <button id="submit" class="button is-primary">
                                    Maak relatie
                                </button>
                            </div>

                            <div class="control">
                                <a href="{{ route('products') }}">Annuleer</a>
                            </div>
                        </div>
                    @endcomponent

                    <input type="hidden" name="country_code" value="nl">
                </form>
            </div>
        </div>
    </div>
@endsection