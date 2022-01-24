@extends('emails._layout.email_base')
@section('content')
    <h6 style="display: inline-block; font-size: 16px; margin: 10px 0; font-weight: 500">
        {{ $budget->customer->full_name }} {{ sprintf(__('budgets.message.status-message'), $budget->isApproved() ? 'aprobado' : 'rechazado') }}
    </h6>
    <div>
        Puedes ver los detalles <a href="{{ route("budget.customer-view", $hash) }}">aquí</a>.
    </div>
@endsection
