<div class="{{ isset($classes['inputContainer']) ? $classes['inputContainer'] : 'form-action-buttons' }}">
    @foreach ($buttons as $button)
        <{{ isset($button['element']) ? $button['element'] : 'button' }}
            class="{{ isset($button['class']) ? $button['class'] : 'button button--default' }}"
            {!! isset($button['type']) ? "type=\"{$button['type']}\"" : '' !!}
            {!! isset($button['href']) ? "href=\"{$button['href']}\"" : '' !!}
            {{ isset($button['disabled']) && $button['disabled'] === true ? 'disabled' : '' }}
        >
            {{ $button['text'] }}
        </{{ isset($button['element']) ? $button['element'] : 'button' }}>
    @endforeach
</div>
