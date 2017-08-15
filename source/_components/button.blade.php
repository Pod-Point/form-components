@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;
@endphp

<div class="{{ isset($classes['inputContainer']) ? $classes['inputContainer'] : FormComponentsServiceProvider::BUTTON_CONTAINER_DEFAULT_CLASS }}">
    @foreach ($buttons as $button)
        <{{ isset($button['element']) ? $button['element'] : 'button' }}
            class="{{ isset($button['class']) ? $button['class'] : FormComponentsServiceProvider::BUTTON_DEFAULT_CLASS }}"
            {!! isset($button['type']) ? "type=\"{$button['type']}\"" : '' !!}
            {!! isset($button['href']) ? "href=\"{$button['href']}\"" : '' !!}
            {{ isset($button['disabled']) && $button['disabled'] === true ? 'disabled' : '' }}
        >
            {{ $button['text'] }}
        </{{ isset($button['element']) ? $button['element'] : 'button' }}>
    @endforeach
</div>
