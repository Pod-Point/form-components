@extends('form::_components.form-group')

@section('label')
    <label class="{{ isset($classes['label']) ? $classes['label'] : 'form__label' }}" for="{{ $name }}">{{ $labelText }}</label>
@overwrite

@section('input')
    <input class="{{ isset($classes['input']) ? $classes['input'] : 'form__control button button--default upload' }}"
           type="file"
           id="{{ $name }}"
           name="{{ $name }}"
           {{ isset($disabled) ? 'disabled' : '' }}
    >
@overwrite
