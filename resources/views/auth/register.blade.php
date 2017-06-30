@extends('layout.app')
@section('content')

    @component('layout/hero')
        Registreer gebruiker
    @endcomponent

    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                @component('layout/panel')
                    <p>Registreer gebruiker</p>

                    @slot('body')
                        <form method="POST" class="form-horizontal" role="form" action="{{ route('register.store') }}">
                            {{ csrf_field() }}

                            <div class="field">
                                <label for="name" class="label">Voornaam</label>

                                <p class="control {{ $errors->has('name') ? ' has-icons-right' : '' }}">
                                    <input id="name"
                                           name="name"
                                           type="text"
                                           value="{{ old('name') }}"
                                           class="input {{ $errors->has('name') ? ' is-danger' : '' }}"
                                           required
                                           autofocus>

                                    @if ($errors->has('name'))
                                        <span class="icon is-small is-right">
                                            <i class="fa fa-warning"></i>
                                        </span>
                                    @endif
                                </p>

                                @if ($errors->has('name'))
                                    <p class="help is-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="field">
                                <label for="last_name" class="label">Achternaam</label>

                                <p class="control {{ $errors->has('last_name') ? ' has-icons-right' : '' }}">
                                    <input id="last_name"
                                           name="last_name"
                                           type="text"
                                           value="{{ old('last_name') }}"
                                           class="input {{ $errors->has('last_name') ? ' is-danger' : '' }}"
                                           required>

                                    @if ($errors->has('last_name'))
                                        <span class="icon is-small is-right">
                                            <i class="fa fa-warning"></i>
                                        </span>
                                    @endif
                                </p>

                                @if ($errors->has('last_name'))
                                    <p class="help is-danger">{{ $errors->first('last_name') }}</p>
                                @endif
                            </div>

                            <div class="field">
                                <label for="email" class="label">Email</label>

                                <p class="control {{ $errors->has('email') ? ' has-icons-right' : '' }}">
                                    <input id="email"
                                           name="email"
                                           type="email"
                                           value="{{ old('email') }}"
                                           class="input {{ $errors->has('email') ? ' is-danger' : '' }}"
                                           required>

                                    @if ($errors->has('email'))
                                        <span class="icon is-small is-right">
                                            <i class="fa fa-warning"></i>
                                        </span>
                                    @endif
                                </p>

                                @if ($errors->has('email'))
                                    <p class="help is-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div class="field">
                                <label for="function" class="label">Functie</label>

                                <p class="control {{ $errors->has('function') ? ' has-icons-right' : '' }}">
                                    <input id="function"
                                           name="function"
                                           type="text"
                                           class="input {{ $errors->has('function') ? ' is-danger' : '' }}"
                                           value="{{ old('function') }}">

                                    @if ($errors->has('function'))
                                        <span class="icon is-small is-right">
                                            <i class="fa fa-warning"></i>
                                        </span>
                                    @endif
                                </p>

                                @if ($errors->has('function'))
                                    <p class="help is-danger">{{ $errors->first('function') }}</p>
                                @endif
                            </div>

                            <div class="field">
                                <label for="role" class="label">Role</label>

                                <select id="role" name="role" class="input">
                                    <option selected disabled>Selecteer een rol</option>

                                    @foreach($roles as $role)
                                        <option
                                            value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('role'))
                                    <p class="help is-danger">{{ $errors->first('role') }}</p>
                                @endif
                            </div>

                            <div class="field is-grouped is-centered">
                                <div class="control">
                                    <button id="submit" class="button is-primary">
                                        Registreer
                                    </button>
                                </div>

                                <div class="control">
                                    <a href="{{ route('users') }}">Annuleer</a>
                                </div>
                            </div>
                        </form>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection