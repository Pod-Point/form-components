@extends('components.form.form-group')

@section('label')
    <label class="form__label {{ $labelClass ?? '' }}" for="{{ $name }}">{{ $labelText }}</label>
@overwrite

@section('input')
    <textarea class="form__control"
           id="{{ $name }}"
           name="{{ $name }}"
    >{{ $value ?? old($name) }}</textarea>
@overwrite
