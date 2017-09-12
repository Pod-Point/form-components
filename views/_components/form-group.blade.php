@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['hasContent'] = isset($classes['hasContent']) ? $classes['hasContent'] : FormComponentsServiceProvider::HAS_CONTENT_DEFAULT_CLASS;
    $classes['hasError'] = isset($classes['hasError']) ? $classes['hasError'] : FormComponentsServiceProvider::HAS_ERROR_DEFAULT_CLASS;
    $classes['errorMessage'] = isset($classes['errorMessage']) ? $classes['errorMessage'] : FormComponentsServiceProvider::ERROR_MESSAGE_DEFAULT_CLASS;
@endphp

<div class="{{ isset($classes['fieldRow']) ? $classes['fieldRow'] : FormComponentsServiceProvider::FIELD_ROW_DEFAULT_CLASS }}
     {{ ($value ?? (isset($app) ? old($name) : null)) ? $classes['hasContent'] : '' }}
     {{ $errors->has($name) ? $classes['hasError'] : '' }}
     ">

     @yield('label')

     <div class="{{ isset($classes['fieldWrapper']) ? $classes['fieldWrapper'] : FormComponentsServiceProvider::FIELD_WRAPPER_DEFAULT_CLASS }}">
         @yield('input')
         {!! $errors->first($name, '<span class="' . $classes['errorMessage'] . '">:message</span>') !!}
     </div>

</div>
