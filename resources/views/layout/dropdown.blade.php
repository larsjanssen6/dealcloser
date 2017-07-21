<div class="field">
    <label for="{{ $name }}" class="label">{{ $label }}</label>

    @if(!empty($array))
        <div class="select">
            <select id="{{ $name }}" name="{{ $name }}"
                    class="input {{ $errors->has($name) ? ' is-danger' : '' }}" required>
                <option selected disabled>Selecteer een {{ lcfirst($label) }}</option>

                @foreach($array as $arr)
                    <option
                        value="{{ $arr[$value] }}" {{ $selected == $arr[$value] ? 'selected' : '' }}>
                        {{ ucfirst($arr[$option]) }}
                    </option>
                @endforeach
            </select>
        </div>

        @if ($errors->has($name))
            <p class="help is-danger">{{ $errors->first($name) }}</p>
        @endif
    @else
        <p>Er zijn geen {{ $label }}.</p>
    @endif
</div>