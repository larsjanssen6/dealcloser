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

                            <div class="control">
                                <label for="name" class="label">Naam:</label>

                                <input id="name"
                                       name="name"
                                       type="text"
                                       value="{{ $user->name }}"
                                       class="input {{ $errors->has('users') ? ' is-danger' : '' }}"
                                       autofocus>

                                @if ($errors->has('name'))
                                    <p class="help is-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="control">
                                <label for="last_name" class="label">Achternaam:</label>

                                <input id="last_name"
                                       name="last_name"
                                       type="text"
                                       value="{{ $user->last_name }}"
                                       class="input {{ $errors->has('last_name') ? ' is-danger' : '' }}"
                                       autofocus>

                                @if ($errors->has('last_name'))
                                    <p class="help is-danger">{{ $errors->first('last_name') }}</p>
                                @endif
                            </div>

                            <div class="control">
                                <label for="email" class="label">Email:</label>

                                <input id="email"
                                       name="email"
                                       type="text"
                                       value="{{ $user->email }}"
                                       class="input">

                                @if ($errors->has('email'))
                                    <p class="help is-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div class="field">
                                <label for="password" class="label">Wachtwoord</label>

                                <p class="control has-icons-left {{ $errors->has('password') ? ' has-icons-right' : '' }}">
                                    <input id="password"
                                           name="password"
                                           type="password"
                                           placeholder="**********"
                                           class="input {{ $errors->has('password') ? ' is-danger' : '' }}">

                                    <span class="icon is-small is-left">
                                    <i class="fa fa-lock"></i>
                                </span>

                                    @if ($errors->has('password'))
                                        <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                    @endif
                                </p>

                                @if ($errors->has('password'))
                                    <p class="help is-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>

                            <div class="field">
                                <label for="password_confirmation" class="label">Bevestig wachtwoord</label>

                                <p class="control has-icons-left {{ $errors->has('password_confirmation') ? ' has-icons-right' : '' }}">
                                    <input id="password_confirmation"
                                           name="password_confirmation"
                                           type="password"
                                           placeholder="**********"
                                           class="input {{ $errors->has('password_confirmation') ? ' is-danger' : '' }}">

                                    <span class="icon is-small is-left">
                                    <i class="fa fa-lock"></i>
                                </span>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                    @endif
                                </p>

                                @if ($errors->has('password_confirmation'))
                                    <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                                @endif
                            </div>

                            <div class="control">
                                <label for="function" class="label">Functie:</label>

                                <input id="function"
                                       name="function"
                                       type="text"
                                       value="{{ $user->function }}"
                                       class="input">

                                @if ($errors->has('function'))
                                    <p class="help is-danger">{{ $errors->first('function') }}</p>
                                @endif
                            </div>

                            <div class="field">
                                <label for="department_id" class="label">Afdeling</label>

                                <select id="department_id" name="department_id"
                                        class="input {{ $errors->has('department_id') ? ' is-danger' : '' }}">
                                    <option selected disabled>Selecteer een afdeling</option>

                                    @foreach($departments as $department)
                                        <option
                                            value="{{ $department->id }}" {{ $department->id == $user->department_id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('department_id'))
                                    <p class="help is-danger">{{ $errors->first('department_id') }}</p>
                                @endif
                            </div>

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