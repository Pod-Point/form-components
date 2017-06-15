@extends('components.form.form-group')

@section('label')
    @if(isset($labelText))
        <span class="form__label">{{ $labelText }}</span>
    @endif
@overwrite

@section('input')
    @php
        $values = old($name, (isset($values) ? $values : []));
        $values = gettype($values) === 'string' ? array($values => $values) : $values;
    @endphp
    @foreach ($options as $key => $option)
        <label class="checkbox {{ $labelClass ?? '' }}" for="{{ count($options) === 1 ? $name : $name . '_' . $key }}">
            <input type="checkbox"
                   name="{{ count($options) === 1 ? $name : $name . '[' . $key . ']' }}"
                   id="{{ count($options) === 1 ? $name :  $name . '[' . $key . ']' }}"
                   value="{{ $key }}"
                   {{ in_array($key, $values) ? 'checked' : '' }}
                   {{ isset($disabled) ? 'disabled' : '' }}
            >
            <span>{{ $option }}</span>
        </label>
    @endforeach
@overwrite
