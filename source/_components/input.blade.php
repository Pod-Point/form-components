@extends('form::_components.form-group')

@section('label')
    <label class="form__label {{ $labelClass ?? '' }}" for="{{ $name }}">{{ $labelText }}</label>
@overwrite

@section('input')
    @php
        $value = $value ?? '';
    @endphp

    <input class="form__control"
           type="{{ $type ?? 'text' }}"
           id="{{ $name }}"
           name="{{ $name }}"
           @if ($type !== 'password')
                value="{{ isset($app) ? old($name, $value) : $value }}"
           @endif
           placeholder="{{ $placeholder ?? '' }}"
           {{ isset($disabled) ? 'disabled' : '' }}
    >
@overwrite
