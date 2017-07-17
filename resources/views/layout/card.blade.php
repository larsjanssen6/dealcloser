<div class="card">
    <section class="{{ isset($meta) ? $meta : 'card-meta' }}">{{ $header }}</section>

    <section class="card-content">
        <header>
            <h3>{{ $slot }}</h3>

            @if(isset($labels))
                @foreach($labels as $label)
                    <a href="#" class="tag">{{ $label }}</a>&nbsp;
                @endforeach
            @endif
        </header>

        @if(isset($footer))
            <article>
                <p>{{ $footer }}</p>
            </article>
        @endif
    </section>
</div>