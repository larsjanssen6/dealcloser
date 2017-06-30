<section class="hero is-primary has-text-centered hero__top">
	<div class="hero-body">
		<div class="container">
			<h1 class="title">
				@if($slot == '')
					DEALCLOSER
					<i class="fa fa-handshake-o" aria-hidden="true"></i>
				@else
					{{ $slot }}
				@endif
			</h1>
		</div>
	</div>
</section>