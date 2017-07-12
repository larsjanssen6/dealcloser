<div class="card">
    <section class="{{ isset($meta) ? $meta : 'card-meta' }}">{{ $header }}</section>

    <section class="card-content">
        <header>
            <h3>{{ $slot }}</h3>

            @if(isset($label))
                <a href="#" class="tag">{{ $label }}</a>&nbsp;
            @endif
        </header>

        @if(isset($footer))
            <article>
                <p>{{ $footer }}</p>
            </article>
        @endif
    </section>
</div>