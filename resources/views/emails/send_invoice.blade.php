@extends('layouts.emails')
@section('content')

    <h3>@lang('emails.dear_user', ['name' => $invoice->customer_name])</h3>

    <h4>@lang('emails.greetings')</h4>

    <p>{!! __('emails.find_an_invoice') !!}</p>

@endsection