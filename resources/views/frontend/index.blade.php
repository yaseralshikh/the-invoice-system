@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>@lang('site.invoices')</h2>
                    <a href="{{ route('invoice.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> @lang('site.create_invoice')</a>
                </div>


                <div class="table-responsive">
                    <table class="table card-table">
                        <thead>
                        <tr>
                            <th>@lang('site.customer_name')</th>
                            <th>@lang('site.invoice_date')</th>
                            <th>@lang('site.total_due')</th>
                            <th>@lang('site.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <td><a href="{{ route('invoice.show', $invoice->id) }}">{{ $invoice->customer_name }}</a></td>
                            <td>{{ $invoice->invoice_date }}</td>
                            <td>{{ $invoice->total_due }}</td>
                            <td>
                                <a href="{{ route('invoice.edit', $invoice->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm('@lang('site.r_u_sure')')) { document.getElementById('delete-{{ $invoice->id }}').submit(); } else { return false; }" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                <form action="{{ route('invoice.destroy', $invoice->id) }}" method="post" id="delete-{{ $invoice->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">
                                <div class="float-right">
                                    {!! $invoices->links() !!}
                                </div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection