@props(['name'])

<span class="label-text-alt">
    @if ($errors->has($name))
        {{ $errors->first($name) }}
    @endif
</span>
