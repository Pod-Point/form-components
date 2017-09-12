@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['label'] = $classes['label'] ?? FormComponentsServiceProvider::LABEL_DEFAULT_CLASS;
    $classes['input'] = $classes['input'] ?? FormComponentsServiceProvider::FILE_UPLOAD_DEFAULT_CLASS;
@endphp

@extends('form::_components.form-group')

@section('label')
    <label class="{{ $classes['label'] }}" for="{{ $name }}">
        {{ $labelText }}
    </label>
@overwrite

@section('input')
    <input
        class="{{ $classes['input'] }}"
        type="file"
        id="{{ $name }}"
        name="{{ $name }}"
        @include('form::_components.attributes')
    >
@overwrite
