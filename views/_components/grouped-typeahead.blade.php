@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['label'] = $classes['label'] ?? FormComponentsServiceProvider::LABEL_DEFAULT_CLASS;
    $classes['inputContainer'] = $classes['inputContainer'] ?? FormComponentsServiceProvider::GROUPED_TYPEAHEAD_CONTAINER_DEFAULT_CLASS;
    $classes['input'] = $classes['input'] ?? FormComponentsServiceProvider::INPUT_DEFAULT_CLASS;
    $classes['select'] = $classes['select'] ?? FormComponentsServiceProvider::SELECT_DEFAULT_CLASS;

    $countryValue = $value ?? old($countryName);
    $countryValue = isset($app) ? old($countryName, $countryValue) : $countryValue;

    $value = $value ?? old($countryName);
    $value = isset($app) ? old($name, $value) : $value;
@endphp

@extends('form::_components.form-group')

@section('label')
    <label class="{{ $classes['label'] }}" for="{{ $name }}">
        {{ $labelText }}
    </label>
@overwrite

@section('input')
    <div class="{{ $classes['inputContainer'] }}">
        <select
                class="{{ $classes['select'] }}"
                id="{{ $countryName }}"
                name="{{ $countryName }}"
                data-js-module="typeahead"
                data-options="{{ $options }}"
                data-default={{ $countryValue }}
                @include('form::_components.attributes')
        >
        </select>

        <input
                class="{{ $classes['input'] }}"
                type="text"
                id="{{ $name }}"
                name="{{ $name }}"
                value="{{ $value }}"
                @include('form::_components.attributes')
        >
    </div>
@overwrite
