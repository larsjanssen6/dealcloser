@extends('layout.app')
@section('content')

    @component('layout/hero')
        GEBRUIKERS
    @endcomponent

    <div class="container">
        <div class="section">
            @can('register-users')
                <div class="column">
                    <a href="{{ route('register.show') }}" class="button is-primary is-outlined">
                        Nieuwe gebruiker
                    </a>
                </div>
            @endcan

            <div class="column">
                <users inline-template v-cloak>
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <abbr>Naam</abbr>
                                    </th>

                                    <th>
                                        <abbr>Achternaam</abbr>
                                    </th>

                                    <th>
                                        <abbr>Actief sinds</abbr>
                                    </th>

                                    <th>
                                        <abbr>Actief</abbr>
                                    </th>

                                    <th>
                                        <abbr>Role</abbr>
                                    </th>

                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($users as $user)
                                    <tr @click="show({{json_encode($user->id)}})">
                                        <td>
                                            {{ $user->name }}
                                        </td>

                                        <td>
                                            {{ $user->last_name }}
                                        </td>

                                        <td>
                                            {{ $user->created_at->diffForHumans() }}
                                        </td>

                                        @if($user->isActive())
                                            <td>
                                                <span class="tag is-success">Ja</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="tag is-danger">Nee</span>
                                            </td>
                                        @endif

                                        <td>
                                            <span class="tag is-warning">
                                                {{ $user->roles->first()->name }}
                                            </span>
                                        </td>

                                        <td>
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </td>
                                    </tr>

                                    <div>
                                        @can('edit-users')
                                            <update-user :prp-user="{{json_encode($user)}}"
                                                         :prp-departments="{{json_encode($departments)}}"
                                                         :prp-roles="{{json_encode($roles)}}">
                                            </update-user>
                                        @else
                                            <user :prp-user="{{json_encode($user)}}"></user>
                                        @endcan
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </users>
            </div>

            <div class="column is-4 is-offset-4">
                {{ $users->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
@endsection