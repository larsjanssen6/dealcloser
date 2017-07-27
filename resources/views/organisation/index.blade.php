@extends('layout.app')
@section('content')

    @component('layout/hero')
        ORGANISATIES
    @endcomponent

    <div class="container">
        <div class="section">
            @if(!$organisations->isEmpty())
                @can('register-organisations')
                    <div class="column">
                        <a href="{{ route('organisations.create') }}" class="button is-primary is-outlined">
                            Nieuwe organisatie
                        </a>
                    </div>
                @endcan
            @endif

            @if(!$organisations->isEmpty())
                <div class="column">
                    <modal-wrapper name="organisation" inline-template v-cloak>
                        <div>
                            <table class="table">
                                <thead class="thead-is-blue">
                                    <tr>
                                        <th>
                                            <abbr>Naam</abbr>
                                        </th>

                                        <th>
                                            <abbr>Account manager</abbr>
                                        </th>

                                        <th>
                                            <abbr>Email</abbr>
                                        </th>

                                        <th>
                                            <abbr>Land</abbr>
                                        </th>

                                        <th>
                                            <abbr>Provincie</abbr>
                                        </th>

                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($organisations as $organisation)
                                        <tr @click="show({{json_encode($organisation->id)}})">
                                            <td>
                                                {{ $organisation->name }}
                                            </td>

                                            <td>
                                                {{ $organisation->account_manager }}
                                            </td>

                                            <td>
                                                {{ $organisation->email }}
                                            </td>

                                            <td>
                                                {{ $organisation->country_code }}
                                            </td>

                                            <td>
                                                {{ $organisation->state_code }}
                                            </td>

                                            <td>
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </td>
                                        </tr>

                                        <div>
                                            @can('edit-organisations')
                                                <update-organisation :prp-organisation="{{json_encode($organisation)}}"
                                                                     :prp-categories="{{json_encode($categories)}}"
                                                                     :prp-products="{{json_encode($products)}}">
                                                </update-organisation>
                                            @else
                                                <organisation :prp-organisation="{{json_encode($organisation)}}"></organisation>
                                            @endcan
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </modal-wrapper>
                </div>
            @else
                <div class="notification is-info">
                    <p>
                        Er zijn momenteel geen organisaties.

                        @can('register-organisations')
                            Maak deze <a href="{{ route('organisations.create') }}">hier</a> aan.
                        @endcan
                    </p>
                </div>
            @endif
        </div>

        <div class="column is-4 is-offset-4">
            {{ $organisations->links('vendor.pagination.default') }}
        </div>
    </div>
@endsection