@extends('layout.app')
@section('content')

	@component('layout/hero') @endcomponent

	<div class="container">
		<div class="columns">
			<div class="column is-half is-offset-one-quarter">
				@component('layout/panel')
					<p>Login</p>

					@slot('body')
						<form method="POST" class="form-horizontal" role="form" action="{{ route('login') }}">
							{{ csrf_field() }}

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
									       autofocus>

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

							<div class="field is-grouped is-centered">
								<div class="control">
									<button id="submit" class="button is-primary">
										Login
									</button>
								</div>

								<div class="control">
									<a @click="showModal = true">Wachtwoord vergeten?</a>
								</div>
							</div>
						</form>
					@endslot
				@endcomponent
			</div>
		</div>

		<modal v-if="showModal" @close="showModal = false">
			<forgot-password @close="showModal = false"></forgot-password>
		</modal>
	</div>
@endsection