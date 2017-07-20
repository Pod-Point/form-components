@extends('form::_components.form-group')

@section('label')
    <label class="form__label {{ $labelClass ?? '' }}" for="{{ $name }}">{{ $labelText }}</label>
@overwrite

@section('input')
    <textarea class="form__control"
              id="{{ $name }}"
              name="{{ $name }}"
              placeholder="{{ $placeholder ?? '' }}"
              {{ isset($disabled) ? 'disabled' : '' }}
    >{{ isset($app) ? old($name, $value) : $value }}</textarea>
@overwrite
