@extends('components.form.form-group')

@section('label')
    @if(isset($labelText))
        <span class="form__label">{{ $labelText }}</span>
    @endif
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
