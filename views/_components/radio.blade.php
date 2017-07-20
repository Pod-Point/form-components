@extends('form::_components.form-group')

@section('label')
    @if(isset($labelText))
        <span class="form__label">{{ $labelText }}</span>
    @endif
@overwrite

@section('input')
    @php
        if (isset($app)) {
            $value = old($name, $value ?? null);
        } else {
            $value =  $value ?? null;
        }
    @endphp
    @foreach ($options as $key => $option)
        <label class="form__label radio {{ $labelClass ?? '' }}" for="{{ $name . '_' . $key }}">
            <input class="form__control"
                   type="radio"
                   id="{{ $name . '_' . $key }}"
                   name="{{ $name }}"
                   value="{{ $key }}"
                   {{ $key === $value ? 'checked' : '' }}
                   {{ isset($disabled) ? 'disabled' : '' }}
            >
            <span>{{ $option }}</span>
        </label>
    @endforeach
@overwrite
