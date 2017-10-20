@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['formGroup'] = $classes['formGroup'] ?? FormComponentsServiceProvider::FORM_GROUP_DEFAULT_CLASS;
    $classes['formGroupError'] = $classes['formGroupError'] ?? FormComponentsServiceProvider::FORM_GROUP_ERROR_CLASS;
    $classes['formErrorSpan'] = $classes['formErrorSpan'] ?? FormComponentsServiceProvider::FORM_ERROR_SPAN_CLASS;

    if ($errors->has($name)) {
        $classes['formGroup'] = $classes['formGroup'] . ' ' . $classes['formGroupError'];
    }
@endphp

<div class="{{ $classes['formGroup'] }}">

    @yield('label')

    @yield('input')

    @if($errors->has($name))
        @foreach($errors->get($name) as $message)
            <span class="{{ $classes['formErrorSpan'] }}">{{ $message }}</span>
        @endforeach
    @endif

</div>
