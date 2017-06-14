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
                    {{ isset($value) && $key === $value ? 'checked' : '' }}
                    {{ isset($disabled) ? 'disabled' : '' }}
            >
            <span>{{ $option }}</span>
        </label>
    @endforeach
@overwrite







{{--@extends('components.form.form-group')--}}

{{--@section('label')--}}
    {{--@if(isset($labelText))--}}
        {{--<span class="form__label">{{ $labelText }}</span>--}}
    {{--@endif--}}
{{--@overwrite--}}

{{--@section('input')--}}
    {{--<div class="radio-wrap {{ ($value ?? old($name)) ? 'has-content' : '' }}">--}}
        {{--@foreach ($options as $key => $option)--}}
            {{--<input class="form__control"--}}
               {{--type="radio"--}}
               {{--id="{{ $key }}"--}}
               {{--name="{{ $name }}"--}}
               {{--value="{{ $key }}"--}}
                {{--{{ isset($value) && $key === $value ? 'checked' : '' }}--}}
            {{-->--}}
            {{--<label class="form__label radio {{ $labelClass ?? '' }}" for="{{ $key }}">--}}
                {{--{{ $option }}--}}
            {{--</label>--}}
        {{--@endforeach--}}
    {{--</div>--}}
{{--@overwrite--}}
