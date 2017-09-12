@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['label'] = $classes['label'] ?? FormComponentsServiceProvider::LABEL_DEFAULT_CLASS;
    $classes['input'] = $classes['input'] ?? FormComponentsServiceProvider::TEXT_AREA_DEFAULT_CLASS;

    $value = $value ?? '';
    $value = isset($app) ? old($name, $value) : $value;
@endphp

@extends('form::_components.form-group')

@section('label')
    <label class="{{ $classes['label'] }}" for="{{ $name }}">
        {{ $labelText }}
    </label>
@overwrite

@section('input')
    <textarea
        class="{{ $classes['input'] }}"
        id="{{ $name }}"
        name="{{ $name }}"
        @include('form::_components.attributes')
    >{{ $value }}</textarea>
@overwrite
