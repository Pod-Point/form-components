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
              @if (isset($attributes))
                   @foreach ($attributes as $attributeName => $attributeValue)
                        {{ $attributeName }}="{{ $attributeValue }}"
                   @endforeach
              @endif
    >{{ isset($app) ? old($name, $value) : $value }}</textarea>
@overwrite
