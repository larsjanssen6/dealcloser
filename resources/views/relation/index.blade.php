@extends('layout.app')
@section('content')

    @component('layout/hero')
        RELATIES
    @endcomponent

    <div class="container">
        <div class="section">
            @if(!$relations->isEmpty())
                @can('register-relations')
                    <div class="column">
                        <a href="{{ route('relations.create') }}" class="button is-primary is-outlined">
                            Nieuwe relatie
                        </a>
                    </div>
                @endcan
            @endif

            @if(!$relations->isEmpty())
                <div class="column">
                    <modal-wrapper name="relation" inline-template v-cloak>
                        <div>
                            <table class="table">
                                <thead class="thead-is-blue">
                                    <tr>
                                        <th>
                                            <abbr>Naam</abbr>
                                        </th>

                                        <th>
                                            <abbr>Email</abbr>
                                        </th>

                                        <th>
                                            <abbr>Functie</abbr>
                                        </th>

                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($relations as $relation)
                                    <tr @click="show({{json_encode($relation->id)}})">
                                        <td>
                                            {{ $relation->full_name }}
                                        </td>

                                        <td>
                                            {{ $relation->email }}
                                        </td>

                                        <td>
                                            {{ $relation->function }}
                                        </td>

                                        <td>
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </td>
                                    </tr>

                                    <div>
                                        @can('edit-relations')
                                            <update-relation relation-id="{{json_encode($relation->id)}}"></update-relation>
                                        @else
                                            <relation :relation-id="{{json_encode($relation->id)}}"></relation>
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
                        Er zijn momenteel geen relaties.

                        @can('register-relations')
                            Maak deze <a href="{{ route('relations.create') }}">hier</a> aan.
                        @endcan
                    </p>
                </div>
            @endif
        </div>

        <div class="column is-4 is-offset-4">
            {{ $relations->links('vendor.pagination.default') }}
        </div>
    </div>
@endsection