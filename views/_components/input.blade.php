@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;
@endphp

@extends('form::_components.form-group')

@section('label')
    <label class="{{ isset($classes['label']) ? $classes['label'] : FormComponentsServiceProvider::LABEL_DEFAULT_CLASS }}" for="{{ $name }}">
        {{ $labelText }}
    </label>
@overwrite

@section('input')
    @php
        $value = $value ?? '';
        $type  = $type ?? 'text'
    @endphp

    <input class="{{ isset($classes['input']) ? $classes['input'] : FormComponentsServiceProvider::INPUT_DEFAULT_CLASS }}"
           type="{{ $type }}"
           id="{{ $name }}"
           name="{{ $name }}"
           @if ($type !== 'password')
                value="{{ isset($app) ? old($name, $value) : $value }}"
           @endif
           placeholder="{{ $placeholder ?? '' }}"
           {{ isset($disabled) ? 'disabled' : '' }}
           @if (isset($attributes))
                @foreach ($attributes as $attributeName => $attributeValue)
                    {{ $attributeName }}="{{ $attributeValue }}"
                @endforeach
           @endif
    >
@overwrite
