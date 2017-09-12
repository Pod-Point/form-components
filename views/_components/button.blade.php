@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['input'] = $classes['input'] ?? FormComponentsServiceProvider::BUTTON_DEFAULT_CLASS;
    $element = $element ?? 'button';
    $name = $name ?? '';
@endphp

<{{ $element }}
    class="{{ $classes['input'] }}"
    id="{{ $name }}"
    name="{{ $name }}"
    @include('form::_components.attributes')
>
    {{ $text }}
</{{ $element }}>
