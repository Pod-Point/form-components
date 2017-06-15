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
           placeholder="{{ $placeholder ?? '' }}"
           @if ($type !== 'password')
                value="{{ old($name, isset($value) ? $value : '') }}"
           @endif
           {{ isset($disabled) ? 'disabled' : '' }}
    >
@overwrite
