@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;

    $classes['label'] = $classes['label'] ?? FormComponentsServiceProvider::LABEL_DEFAULT_CLASS;
    $classes['input'] = $classes['input'] ?? FormComponentsServiceProvider::INPUT_DEFAULT_CLASS;

    $value = $value ?? '';
    $value = isset($app) ? old($name, $value) : $value;
    $type  = $type ?? 'text';
@endphp

@extends('form::_components.form-group')

@section('label')
    <label class="{{ $classes['label'] }}" for="{{ $name }}">
        {{ $labelText }}
    </label>
    @if(isset($explanation))
        <p class="font-size-sm">{{ $explanation }}</p>
    @endif
@overwrite

@section('input')
    <input
        class="{{ $classes['input'] }}"
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        @if ($type !== 'password')
            value="{{ $value }}"
        @endif
        @include('form::_components.attributes')
    >
@overwrite
