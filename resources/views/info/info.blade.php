@extends('layout.app')
@section('content')

	@component('layout/hero')
		INFO
	@endcomponent

	<div class="container">
		<div class="section">
			<div class="container">
				<div class="columns">
					<div class="column is-half is-offset-one-quarter">
						@component('layout/panel')
							<p>Bedrijfsinformatie</p>

							@slot('body')
								<div class="content">
									<h2>Beschrijving</h2>

									<p>{{ settings()->description ?? 'nvt' }}</p>

									<h2>Contact</h2>

									<p>
										<strong>Adres:</strong> <br>
										{{ settings()->address ?? 'nvt' }} <br>
										{{ settings()->zip ?? 'nvt' }} <br>
										{{ settings()->city ?? 'nvt' }} <br>
									</p>

									<p>
										<strong>Tel:</strong> <br>
										{{ settings()->phone ?? 'nvt' }} <br>
										<strong>Email:</strong> <br>
										{{ settings()->email ?? 'nvt' }} <br>
										<strong>Website:</strong> <br>
										<a href="{{ settings()->website ?? '#' }}">{{ settings()->website ?? 'nvt' }}</a>
									</p>

									<h2>Administratie</h2>

									<p>
										<strong>Kvk:</strong> <br>
										{{ settings()->kvk ?? 'nvt' }} <br>
										<strong>Btw:</strong> <br>
										{{ settings()->btw ?? 'nvt' }}
									</p>

									<h2>Dealcloser</h2>

									<p>
										<strong>Licentie code:</strong> <br>
										{{ settings()->license }}
									</p>

									<p>
										<strong>Status applicatie:</strong> <br>
										<span class="tag is-success">Actief</span>
									</p>

								</div>
							@endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection