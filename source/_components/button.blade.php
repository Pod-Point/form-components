<div class="form-action-buttons">
    @foreach ($buttons as $button)
        <{{ $button['element'] }}
                class="button {{ array_has($button, 'class') ? $button['class'] : '' }}"
                {!! array_has($button, 'type') ? "type=\"{$button['type']}\"" : '' !!}
                {!! array_has($button, 'href') ? "href=\"{$button['href']}\"" : '' !!}
        >
            {{ $button['text'] }}
        </{{ $button['element'] }}>
    @endforeach
</div>
