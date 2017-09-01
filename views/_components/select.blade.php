@extends('form::_components.form-group')

@section('label')
    @if(isset($labelText))
        <span class="form__label {{ $labelClass ?? '' }}">{{ $labelText }}</span>
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
    <div class="select-wrapper">
        <select class="form__control"
                id="{{ $name }}"
                name="{{ $name }}"
                {{ isset($disabled) ? 'disabled' : '' }}
                @if (isset($attributes))
                    @foreach ($attributes as $attributeName => $attributeValue)
                        {{ $attributeName }}="{{ $attributeValue }}"
                    @endforeach
                @endif
        >
            @foreach ($options as $key => $option)
                <option value="{{ $key }}" {{ $key == $value ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>
@overwrite
