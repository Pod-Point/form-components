@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['label'] = $classes['label'] ?? FormComponentsServiceProvider::LABEL_DEFAULT_CLASS;
    $classes['inputContainer'] = $classes['inputContainer'] ?? FormComponentsServiceProvider::SELECT_CONTAINER_DEFAULT_CLASS;
    $classes['input'] = $classes['input'] ?? FormComponentsServiceProvider::SELECT_DEFAULT_CLASS;

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
    <div class="{{ $classes['inputContainer'] }}">
        <select
            class="{{ $classes['input'] }}"
            id="{{ $name }}"
            name="{{ $name }}"
            @include('form::_components.attributes')
        >
            @foreach ($options as $key => $option)
                <option value="{{ $key }}" {{ $key == $value ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>
@overwrite
