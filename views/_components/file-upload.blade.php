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
    <input class="{{ isset($classes['input']) ? $classes['input'] : FormComponentsServiceProvider::FILE_UPLOAD_DEFAULT_CLASS }}"
           type="file"
           id="{{ $name }}"
           name="{{ $name }}"
           {{ isset($disabled) ? 'disabled' : '' }}
           @if (isset($attributes))
                @foreach ($attributes as $attributeName => $attributeValue)
                    {{ $attributeName }}="{{ $attributeValue }}"
                @endforeach
           @endif
    >
@overwrite
