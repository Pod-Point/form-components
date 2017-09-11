<{{ isset($element) ? $element : 'button' }}
    class="button {{ $class ?? '' }}"
    {!! isset($type) ? "type=\"{$type}\"" : '' !!}
    {!! isset($href) ? "href=\"{$href}\"" : '' !!}
    {{ isset($disabled) ? 'disabled' : '' }}
    @if (isset($attributes))
        @foreach ($attributes as $attributeName => $attributeValue)
            {{ $attributeName }}="{{ $attributeValue }}"
        @endforeach
    @endif
>
    {{ $text }}
</{{ isset($element) ? $element : 'button' }}>
