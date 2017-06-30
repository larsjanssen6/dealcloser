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
							Update bedrijfslocatie
							<span class="tag is-success">Super admin</span>
						</h2>

						<form method="POST">
							{{ csrf_field() }}

							<input name="_method" type="hidden" value="PATCH">

							<div class="control">
								<label for="name" class="label">Adres:</label>

								<input name="address"
								       type="text"
								       value="{{ settings()->address }}"
								       class="input {{ $errors->has('address') ? ' is-danger' : '' }}"
								       autofocus>

								@if ($errors->has('address'))
									<p class="help is-danger">{{ $errors->first('address') }}</p>
								@endif
							</div>

							<div class="control">
								<label for="zip" class="label">Postcode:</label>

								<input name="zip"
								       type="text"
								       value="{{ settings()->zip }}"
								       class="input {{ $errors->has('zip') ? ' is-danger' : '' }}">

								@if ($errors->has('zip'))
									<p class="help is-danger">{{ $errors->first('zip') }}</p>
								@endif
							</div>

							<div class="control">
								<label for="city" class="label">Woonplaats:</label>

								<input name="city"
								       type="text"
								       value="{{ settings()->city }}"
								       class="input {{ $errors->has('city') ? ' is-danger' : '' }}">

								@if ($errors->has('city'))
									<p class="help is-danger">{{ $errors->first('city') }}</p>
								@endif
							</div>

							<div class="control">
								<button type="submit" class="button is-primary is-outlined">
									Update locatie
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection