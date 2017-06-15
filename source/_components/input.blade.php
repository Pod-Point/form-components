@extends('components.form.form-group')

@php($type = $type ?? 'text')

@section('label')
    <label class="form__label {{ $labelClass ?? '' }}" for="{{ $name }}">{{ $labelText }}</label>
@overwrite

@section('input')
    <input class="form__control"
           type="{{ $type }}"
           id="{{ $name }}"
           name="{{ $name }}"
           {{ isset($disabled) ? 'disabled' : '' }}
           placeholder="{{ $placeholder ?? '' }}"
           @if ($type !== 'password')
                value="{{ old($name, isset($value) ? $value : '') }}"
           @endif
    >
@overwrite
