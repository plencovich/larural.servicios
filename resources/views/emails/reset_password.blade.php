@extends('emails._layout.email_base')
@section('content')
    <h6 style="display: inline-block; font-size: 16px; margin: 10px 0; font-weight: 500">
        {{ $name }},
    </h6>
    <div>
        <p>
            {{ __('view.password_reset') }}
        </p>
        <p>
            {{ __('view.reset_password_instructions') }}
        </p>
        <div style="text-align: center; margin-top: 10px">
            <a style="cursor: pointer; padding: 11px 35px; color: #fff; background-color: #191b27; border: none; border-radius: 8px"
                href="{{ $url }}">{{ __('button.reset') }}</a>
        </div>
        <p style="text-align: center; vertical-align: center">
            {{ __('view.reset_password_warning') }}
        </p>
    </div>
@endsection
