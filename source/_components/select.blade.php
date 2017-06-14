@extends('components.form.form-group')

@section('label')
    <label for="{{ $name }}" class="form__label">{{ $labelText }}</label>
@overwrite

@section('input')
    <div class="select-wrapper">
        <select class="form__control" id="{{ $name }}" name="{{ $name }}">
            @foreach ($options as $key => $option)
                <option value="{{ $key }}" {{ isset($value) && $key === $value ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select>
    </div>
@overwrite
