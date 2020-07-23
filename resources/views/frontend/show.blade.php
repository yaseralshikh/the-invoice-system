@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>@lang('site.invoice', ['invoice_number' => $invoice->invoice_number])</h2>
                    <a href="{{ route('invoice.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> @lang('site.back_to_invoice')</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive p-4" id="print_this">
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
                            <thead style="background-color: rgb(198, 220, 243)">
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
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->unitText() }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit_price }}</td>
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

                    <div class="row">
                        <div class="col-12 text-center">
                            <button class="btn btn-primary btn-sm ml-auto print-btn"><i class="fa fa-print"></i> @lang('site.print')</button>
                            {{-- <a href="{{ route('invoice.print', $invoice->id) }}" class="btn btn-primary btn-sm ml-auto print-btn"><i class="fa fa-print"></i> @lang('site.print')</a> --}}
                            <a href="{{ route('invoice.pdf', $invoice->id) }}" class="btn btn-secondary btn-sm ml-auto"><i class="fa fa-file-pdf"></i> @lang('site.export_pdf')</a>
                            <a href="{{ route('invoice.send_to_email', $invoice->id) }}" class="btn btn-success btn-sm ml-auto"><i class="fa fa-envelope"></i> @lang('site.send_to_email')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script src="{{ asset('frontend/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/printThis.js') }}"></script>

    <script>
        $(document).on('click', '.print-btn', function () {
            $('#print_this').printThis({
                //loadCSS: "padding: 20px;",
                importCSS: true,  
                //header: "<h1 class='text-center text-red'>test</h1>",
                footer: `
                        <p style="padding:10;">@lang('site.cashier') :</p><br><br><hr>
                        <p style="padding:10;">@lang('site.signature') :</p><br><br><hr>
                        <p style="padding:10;">@lang('site.foundation_seal') :</p><br><br><hr>
                `
            });
        });
    </script>
    
@endsection