@php
    $classes['hasContent'] = isset($classes['hasContent']) ? $classes['hasContent'] : 'has-content';
    $classes['hasError'] = isset($classes['hasError']) ? $classes['hasError'] : 'has-error';
    $classes['errorMessage'] = isset($classes['errorMessage']) ? $classes['errorMessage'] : 'form__error';
@endphp

<div class="
     {{ isset($classes['fieldRow']) ? $classes['fieldRow'] : 'form__group field-row' }}
     {{ ($value ?? (isset($app) ? old($name) : null)) ? $classes['hasContent'] : '' }}
     {{ $errors->has($name) ? $classes['hasError'] : '' }}
     ">

     @yield('label')

     <div class="{{ isset($classes['fieldWrapper']) ? $classes['fieldWrapper'] : 'form-field-wrapper' }}">
         @yield('input')
         {!! $errors->first($name, '<span class="' . $classes['errorMessage'] . '">:message</span>') !!}
     </div>

</div>
