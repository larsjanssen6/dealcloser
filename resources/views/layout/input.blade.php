<div class="field">
    <label for="{{ $name }}" class="label">{{ $label }}</label>

    <p class="control {{ $errors->has($name) ? ' has-icons-right' : '' }}">
        <input id="{{ $name }}"
               name="{{ $name }}"
               type="{{ $type or 'text' }}"
               value="{{ $value or old($name) }}"
               class="input {{ $errors->has($name) ? ' is-danger' : '' }}"
               {{ isset($required) ? '' : 'required' }}
               placeholder="{{ $placeholder or "" }}">

        @if ($errors->has($name))
            <span class="icon is-small is-right">
                <i class="fa fa-warning"></i>
            </span>
        @endif
    </p>

    @if ($errors->has($name))
        <p class="help is-danger">{{ $errors->first($name) }}</p>
    @endif
</div>