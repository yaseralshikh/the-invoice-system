@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/pickadate/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/pickadate/classic.date.css') }}">
    @if(config('app.locale') == 'ar')
        <link rel="stylesheet" href="{{ asset('frontend/css/pickadate/rtl.css') }}">
    @endif
    <style>
        form.form label.error, label.error {
            color: red;
            font-style: italic;
        }
    </style>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    @lang('site.create_invoice') 
                    <a href="{{ route('invoice.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> @lang('site.back_to_invoice')</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('invoice.store')}}" method="post" class="form">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_name">@lang('site.customer_name')</label>
                                    <input type="text" name="customer_name" class="form-control">
                                    @error('customer_name')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="customer_email">@lang('site.customer_email')</label>
                                        <input type="text" name="customer_email" class="form-control">
                                        @error('customer_email')
                                            <span class="help-block text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="customer_mobile">@lang('site.customer_mobile')</label>
                                        <input type="text" name="customer_mobile" class="form-control">
                                        @error('customer_mobile')
                                            <span class="help-block text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="company_name">@lang('site.company_name')</label>
                                    <input type="text" name="company_name" class="form-control">
                                    @error('company_name')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="invoice_number">@lang('site.invoice_number')</label>
                                        <input type="text" name="invoice_number" class="form-control">
                                        @error('invoice_number')
                                            <span class="help-block text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="invoice_date">@lang('site.invoice_date')</label>
                                        <input type="text" name="invoice_date" class="form-control pickdate">
                                        @error('invoice_date')
                                            <span class="help-block text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="invoice_details">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>@lang('site.product_name')</th>
                                        <th>@lang('site.unit')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.unit_price')</th>
                                        <th>@lang('site.sub_total')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="cloning_row" id="0">
                                        {{-- <td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td> --}}
                                        <td>#</td>

                                        <td>
                                            <input type="text" name="product_name[0]" id="product_name" class="product_name form-control">
                                            @error('product_name')
                                                <span class="help-block text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td>
                                            <select name="unit[0]" id="unit" class="unit form-control">
                                                <option></option>
                                                <option value="piece">@lang('site.piece')</option>
                                                <option value="g">@lang('site.gram')</option>
                                                <option value="kg">@lang('site.kilo_gram')</option>
                                            </select>
                                            @error('unit')
                                                <span class="help-block text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="number" step="0.01" name="quantity[0]" id="quantity" class="quantity form-control">
                                            @error('quantity')
                                                <span class="help-block text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="number" step="0.01" name="unit_price[0]" id="unit_price" class="unit_price form-control">
                                            @error('unit_price')
                                                <span class="help-block text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="number" step="0.01" name="row_sub_total[0]" id="row_sub_total" class="row_sub_total form-control" readonly='readonly'>
                                            @error('row_sub_total')
                                                <span class="help-block text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <button type="button" class="btn_add btn btn-primary">@lang('site.add_another_product')</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">@lang('site.sub_total')</td>
                                        <td><input type="number" step="0.01" name="sub_total" id="sub_total" class="sub_total form-control" readonly='readonly'></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">@lang('site.discount')</td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <select name="discount_type" id="discount_type" class="discount_type custom-select">
                                                    <option value="fixed">@lang('site.saudi_riyal')</option>
                                                    <option value="percentage">@lang('site.percentage')</option>
                                                </select>

                                                <div class="input-group-append">
                                                    <input type="number" step="0.01" name="discount_value" id="discount_value" class="discount_value form-control" value="0.00">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">@lang('site.vat')</td>
                                        <td><input type="number" step="0.01" name="vat_value" id="vat_value" class="vat_value form-control" readonly='readonly'></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">@lang('site.shipping')</td>
                                        <td><input type="number" step="0.01" name="shipping" id="shipping" class="shipping form-control"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">@lang('site.total_due')</td>
                                        <td><input type="number" step="0.01" name="total_due" id="total_due" class="total_due form-control" readonly='readonly'></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="text-right pt-3">
                            <button type="submit" name="save" class="btn btn-primary">@lang('site.save')</button>
                        </div>
                        

                    </form>
                </div>
            </div>
        </div>
    </div>    

@endsection

@section('script')
    <script src="{{ asset('frontend/js/form_validation/jquery.form.js') }}"></script>
    <script src="{{ asset('frontend/js/form_validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('frontend/js/form_validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('frontend/js/pickadate/picker.js') }}"></script>
    <script src="{{ asset('frontend/js/pickadate/picker.date.js') }}"></script>
    @if(config('app.locale') == 'ar')
        <script src="{{ asset('frontend/js/form_validation/messages_ar.js') }}"></script>
        <script src="{{ asset('frontend/js/pickadate/ar.js') }}"></script>
    @endif
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
@endsection