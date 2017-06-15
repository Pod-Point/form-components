@extends('components.form.form-group')

@section('label')
    @if(isset($labelText))
        <span class="form__label">{{ $labelText }}</span>
    @endif
@overwrite

@section('input')
    @foreach ($options as $key => $option)
        <label class="form__label radio {{ $labelClass ?? '' }}" for="{{ $name . '_' . $key }}">
            <input class="form__control"
                   type="radio"
                   id="{{ $name . '_' . $key }}"
                   name="{{ $name }}"
                   value="{{ $key }}"
                   {{ $key === old($name, isset($value) ? $value : null) ? 'checked' : '' }}
                   {{ isset($disabled) ? 'disabled' : '' }}
            >
            <span>{{ $option }}</span>
        </label>
    @endforeach
@overwrite
