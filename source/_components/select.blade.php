@extends('form::_components.form-group')

@section('label')
    @if(isset($labelText))
        <span class="{{ isset($classes['label']) ? $classes['label'] : 'form__label' }}">
            {{ $labelText }}
        </span>
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
    <div class="{{ isset($classes['inputContainer']) ? $classes['inputContainer'] : 'select-wrapper' }}">
        <select class="{{ isset($classes['input']) ? $classes['input'] : 'form__control' }}"
                id="{{ $name }}" name="{{ $name }}" {{ isset($disabled) ? 'disabled' : '' }}>
            @foreach ($options as $key => $option)
                <option value="{{ $key }}" {{ $key === $value ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>
@overwrite
