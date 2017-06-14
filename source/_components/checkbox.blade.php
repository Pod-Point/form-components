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







{{--@extends('components.form.form-group')--}}

{{--@section('label')--}}

{{--@overwrite--}}

{{--@section('input')--}}
    {{--<div class="checkbox-wrap {{ ($value ?? old($name)) ? 'has-content' : '' }}">--}}
        {{--<input type="checkbox"--}}
               {{--{{ ($value ?? old($name)) ? 'checked' : '' }}--}}
               {{--id="{{ $name }}"--}}
               {{--name="{{ $name }}"--}}
               {{--value="{{ $default ?? 'true' }}">--}}
        {{--<label class="checkbox {{ $labelClass ?? '' }}" for="{{ $name }}">--}}
            {{--{{ $labelText }}--}}
        {{--</label>--}}
    {{--</div>--}}
{{--@overwrite--}}
