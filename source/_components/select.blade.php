@extends('form-group')

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
    <div class="select-wrapper">
        <select class="form__control" id="{{ $name }}" name="{{ $name }}" {{ isset($disabled) ? 'disabled' : '' }}>
            @foreach ($options as $key => $option)
                <option value="{{ $key }}" {{ $key === $value ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>
@overwrite
