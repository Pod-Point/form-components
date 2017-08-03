@extends('form::_components.form-group')

@section('label')
    @if(isset($labelText))
        <span class="{{ isset($classes['label']) ? $classes['label'] : 'form__label' }}">{{ $labelText }}</span>
    @endif
@overwrite

@section('input')
    @php
        if (isset($app)) {
            $value = old($name, $value ?? null);
        } else {
            $value =  $value ?? null;
        }
    @endphp
    @foreach ($options as $key => $option)
        <label class="{{ isset($classes['inputContainer']) ? $classes['inputContainer'] : 'form__label radio' }}" for="{{ $name . '_' . $key }}">
            <input class="{{ isset($classes['input']) ? $classes['input'] : 'form__control' }}"
                   type="radio"
                   id="{{ $name . '_' . $key }}"
                   name="{{ $name }}"
                   value="{{ $key }}"
                   {{ $key === $value ? 'checked' : '' }}
                   {{ isset($disabled) ? 'disabled' : '' }}
            >
            <span>{{ $option }}</span>
        </label>
    @endforeach
@overwrite
