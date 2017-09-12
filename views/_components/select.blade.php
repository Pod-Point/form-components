@php
    use PodPoint\FormComponents\FormComponentsServiceProvider;
@endphp

@extends('form::_components.form-group')

@section('label')
    @if(isset($labelText))
        <span class="{{ isset($classes['label']) ? $classes['label'] : FormComponentsServiceProvider::LABEL_DEFAULT_CLASS }}">
            {{ $labelText }}
        </span>
    @endif
@overwrite

@section('input')
    @php
        if (isset($app)) {
            $value = old($name, $value ?? null);
        } else {
            $value =  $value ?? null;
        }
    @endphp
    <div class="{{ isset($classes['inputContainer']) ? $classes['inputContainer'] : FormComponentsServiceProvider::SELECT_CONTAINER_DEFAULT_CLASS }}">
        <select class="{{ isset($classes['input']) ? $classes['input'] : FormComponentsServiceProvider::SELECT_DEFAULT_CLASS }}"
                id="{{ $name }}"
                name="{{ $name }}"
                {{ isset($disabled) ? 'disabled' : '' }}
                @if (isset($attributes))
                    @foreach ($attributes as $attributeName => $attributeValue)
                        {{ $attributeName }}="{{ $attributeValue }}"
                    @endforeach
                @endif
        >
            @foreach ($options as $key => $option)
                <option value="{{ $key }}" {{ $key == $value ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>
@overwrite
