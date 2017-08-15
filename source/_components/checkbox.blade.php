@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;
@endphp

@extends('form::_components.form-group')

@section('label')
    @if(isset($labelText))
        <span class="{{ isset($classes['label']) ? $classes['label'] : FormComponentsServiceProvider::LABEL_DEFAULT_CLASS }}">
            {{ $labelText }}
        </span>
    @endif
@overwrite

@section('input')
    @php
        if (isset($app)) {
            $values = old($name, ($values ?? []));
        } else {
            $values =  $values ?? [];
        }
        // If value previously set by user and it is a single checkbox, old will return string
        $values = gettype($values) === 'string' ? array($values => $values) : $values;
    @endphp
    @foreach ($options as $key => $option)
        <label class="{{ isset($classes['inputContainer']) ? $classes['inputContainer'] : FormComponentsServiceProvider::CHECKBOX_CONTAINER_DEFAULT_CLASS }}"
               for="{{ count($options) === 1 ? $name : $name . '[' . $key . ']' }}">
            <input type="checkbox"
                   name="{{ count($options) === 1 ? $name : $name . '[' . $key . ']' }}"
                   id="{{ count($options) === 1 ? $name :  $name . '[' . $key . ']' }}"
                   value="{{ $key }}"
                   class="{{ isset($classes['input']) ? $classes['input'] : '' }}"
                   {{ in_array($key, $values) ? 'checked' : '' }}
                   {{ isset($disabled) ? 'disabled' : '' }}
            >
            <span>{{ $option }}</span>
        </label>
    @endforeach
@overwrite
