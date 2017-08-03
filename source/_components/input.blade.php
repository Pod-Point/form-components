@extends('form::_components.form-group')

@section('label')
    <label class="{{ isset($classes['label']) ? $classes['label'] : 'form__label' }}" for="{{ $name }}">{{ $labelText }}</label>
@overwrite

@section('input')
    @php
        $value = $value ?? '';
    @endphp

    <input class="{{ isset($classes['input']) ? $classes['input'] : 'form__control' }}"
           type="{{ $type ?? 'text' }}"
           id="{{ $name }}"
           name="{{ $name }}"
           @if (!isset($type) || $type !== 'password')
                value="{{ isset($app) ? old($name, $value) : $value }}"
           @endif
           placeholder="{{ $placeholder ?? '' }}"
           {{ isset($disabled) ? 'disabled' : '' }}
    >
@overwrite
