@extends('layout.app')
@section('content')

	@component('layout/hero')
		DASHBOARD
	@endcomponent

	<div class="container">
		<div class="tile is-4 is-vertical" style="margin-top: 10px;">
			<article class="tile is-child notification is-danger slideRight">
				<p class="title">Projecten</p>
				<p class="subtitle">3</p>
			</article>

			<article class="tile is-child notification slideRight">
				<p class="title">Opportunities</p>
				<p class="subtitle">3 lopend, 2 afgesloten</p>
			</article>

			<article class="tile is-child notification is-warning slideRight">
				<p class="title">Gebruikers</p>
				<p class="subtitle">4 actief, 3 inactief</p>
			</article>
		</div>
	</div>
@endsection