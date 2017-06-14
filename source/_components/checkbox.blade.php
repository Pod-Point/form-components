@extends('components.form.form-group')

@section('label')
    @if(isset($labelText))
        <span class="form__label">{{ $labelText }}</span>
    @endif
@overwrite

@section('input')
    @foreach ($options as $key => $option)
        <label class="checkbox {{ $labelClass ?? '' }}" for="{{ $name }}">
            <input type="checkbox"
                   {{ ($value ?? old($name)) ? 'checked' : '' }}
                   {{ isset($disabled) ? 'disabled' : '' }}
                   id="{{ $name . '_' . $key }}"
                   name="{{ $name }}"
                   value="{{ $key ?? 'true' }}">

            <span>{{ $option }}</span>
        </label>
    @endforeach
@overwrite
