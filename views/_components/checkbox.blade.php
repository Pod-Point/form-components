@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['label'] = $classes['label'] ?? FormComponentsServiceProvider::LABEL_DEFAULT_CLASS;
    $classes['inputContainer'] = $classes['inputContainer'] ?? FormComponentsServiceProvider::CHECKBOX_CONTAINER_DEFAULT_CLASS;
    $classes['input'] = $classes['input'] ?? FormComponentsServiceProvider::CHECKBOX_DEFAULT_CLASS;

    $values = $values ?? [];
    $values = isset($app) ? old($name, $values) : $values;
    // If value previously set by user and it is a single checkbox, old will return string
    $values = gettype($values) === 'string' ? array($values => $values) : $values;
@endphp

@extends('form::_components.form-group')

@section('label')
    @if(isset($labelText))
        <span class="{{ $classes['label'] }}">
            {{ $labelText }}
        </span>
    @endif
@overwrite

@section('input')
    @foreach ($options as $key => $option)
        <label
            class="{{ $classes['inputContainer'] }}"
            for="{{ count($options) === 1 ? $name : $name . '[' . $key . ']' }}"
        >
            <input
                type="checkbox"
                name="{{ count($options) === 1 ? $name : $name . '[' . $key . ']' }}"
                id="{{ count($options) === 1 ? $name :  $name . '[' . $key . ']' }}"
                value="{{ $key }}"
                class="{{ $classes['input'] }}"
                {{ in_array($key, $values) ? 'checked' : '' }}
                @include('form::_components.attributes')
            >
            <span>{{ $option }}</span>
        </label>
    @endforeach
@overwrite
