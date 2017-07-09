@extends('layout.app')
@section('content')

    @component('layout/hero')
        RELATIES
    @endcomponent

    <div class="container">
        <div class="section">
            @can('register-users')
                <div class="column">
                    <a href="{{ route('relations.create') }}" class="button is-primary is-outlined">
                        Nieuwe relatie
                    </a>
                </div>
            @endcan
        </div>
    </div>
@endsection