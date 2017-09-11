<{{ isset($button['element']) ? $button['element'] : 'button' }}
    class="button {{ $button['class'] ?? '' }}"
    {!! isset($button['type']) ? "type=\"{$button['type']}\"" : '' !!}
    {!! isset($button['href']) ? "href=\"{$button['href']}\"" : '' !!}
    {{ isset($button['disabled']) ? 'disabled' : '' }}
    @if (isset($button['attributes']))
        @foreach ($button['attributes'] as $attributeName => $attributeValue)
            {{ $attributeName }}="{{ $attributeValue }}"
        @endforeach
    @endif
>
    {{ $button['text'] }}
</{{ isset($button['element']) ? $button['element'] : 'button' }}>
