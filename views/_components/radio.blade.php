@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['label'] = $classes['label'] ?? FormComponentsServiceProvider::LABEL_DEFAULT_CLASS;
    $classes['inputContainer'] = $classes['inputContainer'] ?? FormComponentsServiceProvider::RADIO_CONTAINER_DEFAULT_CLASS;
    $classes['input'] = $classes['input'] ?? FormComponentsServiceProvider::RADIO_DEFAULT_CLASS;

    $value = $value ?? null;
    $value = isset($app) ? old($name, $value) : $value;
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
            for="{{ $name . '_' . $key }}"
        >
            <input
                class="{{ $classes['input'] }}"
                type="radio"
                id="{{ $name . '_' . $key }}"
                name="{{ $name }}"
                value="{{ $key }}"
                {{ $key === $value ? 'checked' : '' }}
                @include('form::_components.attributes')
            >
            <span>{{ $option }}</span>
        </label>
    @endforeach
@overwrite
