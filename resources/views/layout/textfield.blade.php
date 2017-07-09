<div class="control">
    <label for="{{ $name }}" class="label">{{ $label }}</label>

    <textarea id="{{ $name }}"
              name="{{ $name }}"
              type="{{ $type or 'text' }}"
              class="input">{{ $value }}
    </textarea>

    @if ($errors->has($name))
        <p class="help is-danger">{{ $errors->first($name) }}</p>
    @endif
</div>
