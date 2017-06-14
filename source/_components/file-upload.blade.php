@extends('components.form.form-group')

@section('label')
    <label class="form__label {{ $labelClass ?? '' }}" for="{{ $name }}">{{ $labelText }}</label>
@overwrite

@section('input')
    <input class="form__control button button--default upload"
           type="file"
           id="{{ $name }}"
           name="{{ $name }}"
    >
@overwrite