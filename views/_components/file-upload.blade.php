@extends('form::_components.form-group')

@section('label')
    <label class="form__label {{ $labelClass ?? '' }}" for="{{ $name }}">{{ $labelText }}</label>
@overwrite

@section('input')
    <input class="form__control button button--default upload"
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
