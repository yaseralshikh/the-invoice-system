@extends('layouts.print')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="print_this">
                <div class="card-header d-flex">
                    <h2>@lang('site.invoice', ['invoice_number' => $invoice->invoice_number])</h2>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>@lang('site.customer_name')</th>
                                <td>{{ $invoice->customer_name }}</td>
                                <th>@lang('site.customer_email')</th>
                                <td>{{ $invoice->customer_email }}</td>
                            </tr>
                            <tr>
                                <th>@lang('site.customer_mobile')</th>
                                <td>{{ $invoice->customer_mobile }}</td>
                                <th>@lang('site.company_name')</th>
                                <td>{{ $invoice->company_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('site.invoice_number')</th>
                                <td>{{ $invoice->invoice_number }}</td>
                                <th>@lang('site.invoice_date')</th>
                                <td>{{ $invoice->invoice_date }}</td>
                            </tr>
                        </table>

                        <h3>@lang('site.invoice_details')</h3>

                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('site.product_name')</th>
                                <th>@lang('site.unit')</th>
                                <th>@lang('site.quantity')</th>
                                <th>@lang('site.unit_price')</th>
                                <th>@lang('site.product_subtotal')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoice->details as $item)
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td width="35%">{{ $item->product_name }}</td>
                                <td width="10%">{{ $item->unitText() }}</td>
                                <td width="10%">{{ $item->quantity }}</td>
                                <td width="10%">{{ $item->unit_price }}</td>
                                <td>{{ $item->row_sub_total }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <th colspan="2">@lang('site.sub_total')</th>
                                <td>{{ $invoice->sub_total }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <th colspan="2">@lang('site.discount')</th>
                                <td>{{ $invoice->discountResult() }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <th colspan="2">@lang('site.vat')</th>
                                <td>{{ $invoice->vat_value }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <th colspan="2">@lang('site.shipping')</th>
                                <td>{{ $invoice->shipping }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <th colspan="2">@lang('site.total_due')</th>
                                <td>{{ $invoice->total_due }}</td>
                            </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        //window.print();
        $(function () {
            $('#print_this').printThis();
        })
    </script>
@endsection