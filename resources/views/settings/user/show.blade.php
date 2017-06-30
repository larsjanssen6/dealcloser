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
							<span class="tag is-success">Super admin</span>
						</h2>

						<form method="POST">
							{{ csrf_field() }}

							<!--data-->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection