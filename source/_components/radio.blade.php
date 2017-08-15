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
            $value = old($name, $value ?? null);
        } else {
            $value =  $value ?? null;
        }
    @endphp
    @foreach ($options as $key => $option)
        <label class="{{ isset($classes['inputContainer']) ? $classes['inputContainer'] : FormComponentsServiceProvider::RADIO_CONTAINER_DEFAULT_CLASS }}"
               for="{{ $name . '_' . $key }}">
            <input class="{{ isset($classes['input']) ? $classes['input'] : FormComponentsServiceProvider::RADIO_DEFAULT_CLASS }}"
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
