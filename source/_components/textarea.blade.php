@extends('form::_components.form-group')

@section('label')
    <label class="{{ isset($classes['label']) ? $classes['label'] : 'form__label' }}" for="{{ $name }}">{{ $labelText }}</label>
@overwrite

@section('input')
    <textarea class="{{ isset($classes['input']) ? $classes['input'] : 'form__control' }}"
              id="{{ $name }}"
              name="{{ $name }}"
              placeholder="{{ $placeholder ?? '' }}"
              {{ isset($disabled) ? 'disabled' : '' }}
    >{{ isset($app) ? old($name, $value) : $value }}</textarea>
@overwrite
