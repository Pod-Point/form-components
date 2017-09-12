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
    <textarea class="{{ isset($classes['input']) ? $classes['input'] : FormComponentsServiceProvider::TEXT_AREA_DEFAULT_CLASS }}"
              id="{{ $name }}"
              name="{{ $name }}"
              placeholder="{{ $placeholder ?? '' }}"
              {{ isset($disabled) ? 'disabled' : '' }}
              @if (isset($attributes))
                   @foreach ($attributes as $attributeName => $attributeValue)
                        {{ $attributeName }}="{{ $attributeValue }}"
                   @endforeach
              @endif
    >{{ isset($app) ? old($name, $value) : $value }}</textarea>
@overwrite
