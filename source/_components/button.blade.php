<div class="form-action-buttons">
    @foreach ($buttons as $button)
        <{{ $button['element'] }}
            class="button {{ $button['class'] ?? '' }}"
            {!! isset($button['type']) ? "type=\"{$button['type']}\"" : '' !!}
            {!! isset($button['href']) ? "href=\"{$button['href']}\"" : '' !!}
        >
            {{ $button['text'] }}
        </{{ $button['element'] }}>
    @endforeach
</div>
