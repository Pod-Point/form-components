@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['formGroup'] = $classes['formGroup'] ?? FormComponentsServiceProvider::FORM_GROUP_DEFAULT_CLASS;
@endphp

<div class="{{ $classes['formGroup'] }}">

    @yield('label')

    @yield('input')

</div>
