<div class="field">
    <label for="{{ $name }}" class="label">{{ $label }}</label>

    @if(!$collection->isEmpty())
        <select id="{{ $name }}" name="{{ $name }}"
                class="input {{ $errors->has($name) ? ' is-danger' : '' }}" required>
            <option selected disabled>Selecteer een {{ $label }}</option>

            @foreach($collection as $c)
                <option
                    value="{{ $c->$value }}" {{ old($name) == $c->id ? 'selected' : '' }}>
                    {{ $c->$option }}
                </option>
            @endforeach
        </select>

        @if ($errors->has($name))
            <p class="help is-danger">{{ $errors->first($name) }}</p>
        @endif
    @else
        <p>Er zijn geen {{ $label }}.</p>
    @endif
</div>