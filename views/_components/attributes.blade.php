@if (isset($attributes))
    @foreach ($attributes as $attributeName => $attributeValue)
        @if (is_bool($attributeValue))
            @if ($attributeValue === true)
                {{ $attributeName }}
            @endif
        @else
            {{ $attributeName }}="{{ $attributeValue }}"
        @endif
    @endforeach
@endif
