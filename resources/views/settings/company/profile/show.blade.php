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
							Update bedrijfsprofiel
							<span class="tag is-success">Super admin</span>
						</h2>

						<form method="POST">
							{{ csrf_field() }}

							<input name="_method" type="hidden" value="PATCH">

							<div class="control">
								<label for="name" class="label">Naam:</label>

								<input name="name"
								       type="text"
								       value="{{ settings()->name }}"
								       class="input {{ $errors->has('name') ? ' is-danger' : '' }}"
								       autofocus>

								@if ($errors->has('name'))
									<p class="help is-danger">{{ $errors->first('name') }}</p>
								@endif
							</div>

							<div class="control">
								<label for="email" class="label">Email:</label>

								<input name="email"
								       type="email"
								       value="{{ settings()->email }}"
								       class="input">

								@if ($errors->has('email'))
									<p class="help is-danger">{{ $errors->first('email') }}</p>
								@endif
							</div>

							<div class="control">
								<label for="phone" class="label">Telefoon:</label>

								<input name="phone"
								       type="text"
								       value="{{ settings()->phone }}"
								       class="input">

								@if ($errors->has('phone'))
									<p class="help is-danger">{{ $errors->first('phone') }}</p>
								@endif
							</div>

							<div class="control">
								<label for="website" class="label">Website:</label>

								<input name="website"
								       type="text"
								       value="{{ settings()->website }}"
								       class="input">

								@if ($errors->has('website'))
									<p class="help is-danger">{{ $errors->first('website') }}</p>
								@endif
							</div>

							<label for="phone" class="label">Omschrijving:</label>

							<div class="control">
								<textarea name="description"
								          type="text"
								          class="input">{{ settings()->description }}
								</textarea>

								@if ($errors->has('description'))
									<p class="help is-danger">{{ $errors->first('description') }}</p>
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