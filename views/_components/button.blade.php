@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;
@endphp

<div class="{{ isset($classes['inputContainer']) ? $classes['inputContainer'] : FormComponentsServiceProvider::BUTTON_CONTAINER_DEFAULT_CLASS }}">
    <{{ isset($element) ? $element : 'button' }}
        class="{{ isset($class) ? $class : FormComponentsServiceProvider::BUTTON_DEFAULT_CLASS }}"
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
</div>
