@extends('emails._layout.email_base')
@section('content')
    <h6 style="display: inline-block; font-size: 16px; margin: 10px 0; font-weight: 500">
        {{ __('email.hello') }} {{ $name }},
    </h6>
    <div>
        <p>
            {{ __('email.user_welcome') }}
        </p>
        <p>
            {{ __('email.access_date') }}
        </p>
        <p><strong>{{ __('view.user') }}:</strong> {{ $email }}</p>
        <p><strong>{{ __('view.password') }}:</strong> {{ $password }}</p>
        <div style="text-align: center; margin-top: 10px">
            <a style="cursor: pointer; padding: 11px 35px; color: #fff; background-color: #191b27; border: none; border-radius: 8px"
                href="{{ $url }}">{{ __('button.login') }}</a>
        </div>
    </div>
@endsection
