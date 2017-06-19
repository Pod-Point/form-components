<div class="form-action-buttons">
    @foreach ($buttons as $button)
        <{{ $button['element'] ?? 'button' }}
            class="button {{ $button['class'] ?? '' }}"
            {!! isset($button['type']) ? "type=\"{$button['type']}\"" : '' !!}
            {!! isset($button['href']) ? "href=\"{$button['href']}\"" : '' !!}
            {{ isset($button['disabled']) ? 'disabled' : '' }}
        >
            {{ $button['text'] }}
        </{{ $button['element'] }}>
    @endforeach
</div>
