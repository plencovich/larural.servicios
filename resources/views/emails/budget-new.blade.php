@extends('emails._layout.email_base')
@section('content')
    <h6 style="display: inline-block; font-size: 16px; margin: 10px 0; font-weight: 500">
        {{ __('email.hello') }},
    </h6>
    <div>
        <p>
            Tenes un nuevo presupuesto para la Rural.
        </p>
    </div>
@endsection
