@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['input'] = $classes['input'] ?? FormComponentsServiceProvider::BUTTON_DEFAULT_CLASS;
    $element = $element ?? 'button';
    $name = $name ?? '';
@endphp

<{{ $element }}
    class="{{ $classes['input'] }}"
    id="{{ $name }}"
    @if ($element === 'button')
        name="{{ $name }}"
    @endif
    @include('form::_components.attributes')
>
    {{ $text }}
</{{ $element }}>
