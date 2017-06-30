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
							Rollen
							<span class="tag is-success">Super admin</span>
						</h2>

						<roles :prp-roles="{{ json_encode($roles) }}"></roles>

						<div class="column is-5">
							<form method="POST" class="form-horizontal" role="form"
							      action="{{ route('settings.rights.role') }}">
								{{ csrf_field() }}

								<div class="field">
									<p class="control {{ $errors->has('name') ? ' has-icons-right' : '' }}">
										<input type="text"
										       class="input {{ $errors->has('name') ? ' is-danger' : '' }}"
										       id="name"
										       name="name"
										       value="{{ old('name') }}"
										       placeholder="Typ hier de rol naam die u wilt toevoegen"
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

								<div class="field is-grouped is-centered">
									<div class="control">
										<button id="submit" class="button is-primary">
											Maak rol
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection