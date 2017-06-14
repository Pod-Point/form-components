<div class="form__group field-row {{ ($value ?? old($name)) ? 'has-content' : '' }} {{ $errors->has($name) ? 'has-error' : '' }}">
    @yield('label')

    <div class="form-field-wrapper">
        @yield('input')

        {!! $errors->first($name, '<span class="form__error">:message</span>') !!}
    </div>

</div>
