<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@lang('site.invoice', ['invoice_number', $invoice_number])</title>

        <style>
            body {
                font-family: 'XBRiyazBd', sans-serif;
            }

            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 30px;
                font-size: 9px;
                line-height: 24px;
                font-family: 'XBRiyaz', sans-serif;
                color: #555;
            }

            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: right;
            }

            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }

            .invoice-box table tr td {
                text-align: left;
            }

            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.top table td.title {
                font-size: 30px;
                line-height: 45px;
                color: #333;
            }

            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }

            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }

            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.item td{
                border-bottom: 1px solid #eee;
            }

            .invoice-box table tr.item.last td {
                border-bottom: none;
            }

            .invoice-box table tr.total td {
                border-top: 2px solid #eee;
                font-weight: bold;
            }

            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }

                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }

            /** RTL **/
            .rtl {
                direction: rtl;
                font-family: 'XBRiyaz', sans-serif;
            }

            .rtl table {
                text-align: right;
            }

            .rtl table tr td {
                text-align: right;
            }

            @page {
                header: page-header;
                footer: page-footer;
            }
        </style>
    </head>

    <body>
    <div class="invoice-box {{ config('app.locale') == 'ar' ? 'rtl' : '' }}">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td width="65%" class="title">
                                <img src="{{ asset('frontend/images/logo.png') }}" style="width:100px; max-width:100px;">
                            </td>

                            <td width="35%">
                                @lang('site.serial'): {{ $invoice_number }}<br>
                                @lang('site.date'): {{ $invoice_date }}<br>
                                @lang('site.print_date'): {{ Carbon\Carbon::now()->format('Y-m-d') }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><h2>@lang('site.invoice_title')</h2></td>
                        </tr>

                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td width="50%">
                                <h2>@lang('site.seller')</h2>
                                @lang('site.seller_name')<br>
                                <span dir="ltr">@lang('site.seller_phone')</span><br>
                                @lang('site.seller_vat')<br>
                                @lang('site.seller_address')
                            </td>

                            <td width="50%">
                                <h2>@lang('site.buyer')</h2>
                                @foreach($customer as $key => $val)
                                    {{ $key }}: {{ $val }}<br>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td></td>
                <td>@lang('site.product_name')</td>
                <td>@lang('site.unit')</td>
                <td>@lang('site.quantity')</td>
                <td>@lang('site.unit_price')</td>
                <td>@lang('site.sub_total')</td>
            </tr>

            @foreach($items as $item)
                <tr class="item {{ $loop->last ? 'last' : '' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['unit'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>@lang('site.sar_with_amount', ['amount' => $item['unit_price']])</td>
                    <td>@lang('site.sar_with_amount', ['amount' => $item['row_sub_total']])</td>
                </tr>
            @endforeach

            <tr class="total">
                <td colspan="4"></td>
                <td>@lang('site.sub_total')</td>
                <td>@lang('site.sar_with_amount', ['amount' => $sub_total])</td>
            </tr>

            <tr class="total">
                <td colspan="4"></td>
                <td>@lang('site.discount')</td>
                <td>@lang('site.sar_with_amount', ['amount' => $discount])</td>
            </tr>
            <tr class="total">
                <td colspan="4"></td>
                <td>@lang('site.vat')</td>
                <td>@lang('site.sar_with_amount', ['amount' => $vat_value])</td>
            </tr>
            <tr class="total">
                <td colspan="4"></td>
                <td>@lang('site.shipping')</td>
                <td>@lang('site.sar_with_amount', ['amount' => $shipping])</td>
            </tr>
            <tr class="total">
                <td colspan="4"></td>
                <td>@lang('site.total_due')</td>
                <td>@lang('site.sar_with_amount', ['amount' => $total_due])</td>
            </tr>
        </table>
    </div>
    </body>
</html>