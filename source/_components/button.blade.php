<div class="form-action-buttons">
    @foreach ($buttons as $button)
        <{{ isset($button['element']) ? $button['element'] : 'button' }}
            class="button {{ $button['class'] ?? '' }}"
            {!! isset($button['type']) ? "type=\"{$button['type']}\"" : '' !!}
            {!! isset($button['href']) ? "href=\"{$button['href']}\"" : '' !!}
            {{ isset($button['disabled']) ? 'disabled' : '' }}
        >
            {{ $button['text'] }}
        </{{ isset($button['element']) ? $button['element'] : 'button' }}>
    @endforeach
</div>
