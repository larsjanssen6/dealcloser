@extends('layout.app')
@section('content')

    @component('layout/hero')
        RELATIES
    @endcomponent

    <div class="container">
        <div class="section">
            @can('register-relations')
                <div class="column">
                    <a href="{{ route('relations.create') }}" class="button is-primary is-outlined">
                        Nieuwe relatie
                    </a>
                </div>
            @endcan

            <div class="column">
                <relations inline-template v-cloak>
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <abbr>Organisatie</abbr>
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
                                @foreach($relations as $relation)
                                    <tr @click="show({{json_encode($relation->id)}})">
                                        <td>
                                            {{ $relation->organisation }}
                                        </td>

                                        <td>
                                            {{ $relation->account_manager }}
                                        </td>

                                        <td>
                                            {{ $relation->email }}
                                        </td>

                                        <td>
                                            {{ $relation->country_code }}
                                        </td>

                                        <td>
                                            {{ $relation->state_code }}
                                        </td>

                                        <td>
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </td>
                                    </tr>

                                    <div>
                                        @can('edit-relations')
                                            <update-relation :prp-relation="{{json_encode($relation)}}"
                                                             :prp-categories="{{json_encode($categories)}}"
                                                             :prp-countries="{{json_encode($countries)}}">
                                            </update-relation>
                                        @else
                                            <relation :prp-relation="{{json_encode($relation)}}"></relation>
                                        @endcan
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </relations>
            </div>
        </div>

        <div class="column is-4 is-offset-4">
            {{ $relations->links('vendor.pagination.default') }}
        </div>
    </div>
@endsection