@extends('layout.app')
@section('content')

	@component('layout/hero') @endcomponent

	<div class="container">
		<div class="columns">
			<div class="column is-half is-offset-one-quarter">
				@component('layout/panel')
					<p>Wachtwoord reset</p>

					@slot('body')
						<form method="POST" class="form-horizontal" role="form">
							{{ csrf_field() }}

							<input type="hidden" name="token" value="{{ $token }}">

							<div class="field">
								<label for="email" class="label">
									Email
								</label>

								<p class="control has-icons-left {{ $errors->has('email') ? ' has-icons-right' : '' }}">
									<input type="email"
									       class="input {{ $errors->has('email') ? ' is-danger' : '' }}"
									       id="email"
									       name="email"
									       value="{{ old('email') }}"
									       required
									       autofocus
									       v-focus>

									<span class="icon is-small is-left">
								        <i class="fa fa-envelope"></i>
								    </span>

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
								<label for="password" class="label">
									Wachtwoord
								</label>

								<p class="control has-icons-left {{ $errors->has('password') ? ' has-icons-right' : '' }}">
									<input type="password"
									       class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
									       id="password"
									       name="password"
									       required>

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
								<label for="password_confirmation" class="label">
									Bevestig wachtwoord
								</label>

								<p class="control has-icons-left {{ $errors->has('password_confirmation') ? ' has-icons-right' : '' }}">
									<input type="password"
									       class="input {{ $errors->has('password_confirmation') ? ' is-danger' : '' }}"
									       id="password_confirmation"
									       name="password_confirmation"
									       required>

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

							<div class="field is-grouped is-centered">
								<div class="control">
									<button id="submit" class="button is-primary">
										Reset wachtwoord
									</button>
								</div>

								<div class="control">
									<a href="/">Annuleer</a>
								</div>
							</div>
						</form>
					@endslot
				@endcomponent
			</div>
		</div>
	</div>
@endsection