@extends('backend.master')
@section('document-title') Due Transaction @endsection
@section('page-title') Due Transaction Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('due-transaction-form') }}">Due Transaction</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <style>
        .table th{
            vertical-align: middle;
        }
    </style>

    <form class="due" action="{{ route('due-transaction') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12 pl-lg-0">
                <div class="card">
                    <div class="card-header font-weight-bold text-info"><i class="bx bx-money"></i> Payment Details</div>
                    <div class="card-body p-0">
                        <table class="table table-bordered mb-0">
                            <tbody>
                            <tr>
                                <th class="text-right low-height pt-2 pb-2" style="width: 150px">Client Type</th>
                                <td class="p-1">
                                    <select class="form-control p-1 low-height" onchange="client()" name="client_type" style="width: 100%" required>
                                        <option value="">--Select--</option>
                                        @foreach(clientType() as $type)
                                            <option value="{{ $type->name }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr id="client">
                                <th class="text-right low-height pt-2 pb-2">Client</th>
                                <td class="p-1">
                                    <select class="form-control select2 p-1 low-height" onchange="clientBalance()" name="client_id" style="width: 100%">
                                        <option value="">--Select--</option>
                                    </select>
                                </td>
                            </tr>

                            <tr id="pastBalance">
                                <th class="pt-2 pb-2 text-right">Balance</th>
                                <td class="p-1">
                                    <div class="input-group">
                                        <input type="number" name="past_balance" value="0" min="0" step="0.01" class="form-control low-height" readonly/>
                                        <div class="input-group-append low-height">
                                            <span class="input-group-text past-balance-title" id="pastBalanceTitle">Credit</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{--                                            <tr>--}}
                            {{--                                                <th class="pt-2 pb-2 text-right">Transport Cost</th>--}}
                            {{--                                                <td class="p-1">--}}
                            {{--                                                    <div class="input-group">--}}
                            {{--                                                        <input type="number" name="transport_cost"--}}
                            {{--                                                               onclick="this.select()" onblur="saleCalculate()" onchange="saleCalculate()"--}}
                            {{--                                                               value="0" min="0" step="0.01" class="form-control low-height"  required/>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </td>--}}
                            {{--                                            </tr>--}}
                            {{--                                            <tr>--}}
                            {{--                                                <th class="pt-2 pb-2 text-right">Labour Cost</th>--}}
                            {{--                                                <td class="p-1">--}}
                            {{--                                                    <div class="input-group">--}}
                            {{--                                                        <input type="number" name="labour_cost"--}}
                            {{--                                                               onclick="this.select()" onblur="saleCalculate()" onchange="saleCalculate()"--}}
                            {{--                                                               value="0" min="0" step="0.01" class="form-control low-height"  required/>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </td>--}}
                            {{--                                            </tr>--}}
                            {{--                                            <tr>--}}
                            {{--                                                <th class="pt-2 pb-2 text-right">Today Total</th>--}}
                            {{--                                                <td class="p-1">--}}
                            {{--                                                    <div class="input-group">--}}
                            {{--                                                        <input type="number" name="total" value="0" min="0" step="0.01" class="form-control low-height" readonly/>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </td>--}}
                            {{--                                            </tr>--}}
                            <tr>
                                <th class="pt-2 pb-2 text-right" id="amountTitle">Received</th>
                                <td class="p-1">
                                    <div class="input-group">
                                        <input type="number" name="amount"
                                               onclick="this.select()" onblur="dueCalculate()" onkeyup="dueCalculate()"
                                               value="0" min="0" step="0.01" class="form-control low-height"  required/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th class="pt-2 pb-2 text-right">Media</th>
                                <td class="p-1">
                                    <select name="payment_media" onchange="paymentMedia()" class="form-control low-height p-1">
                                        <option value="Cash">Cash</option>
                                        <option value="Bank">Bank</option>
                                    </select>
                                </td>
                            </tr>

                            <tr id="bank" style="display: none">
                                <th class="pt-2 pb-2 text-right">Account</th>
                                <td class="p-1">
                                    <select class="form-control p-1 low-height" name="bank_account_id">
                                        <option value="">--Select Bank Account--</option>
                                        @foreach(activeBankAccounts() as $account)
                                            <option value="{{ $account->id }}" {{ old('bank_account_id') == $account->id ? 'selected':'' }}>{{ $account->bank->code.': '.$account->ac_no }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th class="pt-2 pb-2 text-right">Discount</th>
                                <td class="p-1">
                                    <div class="input-group">
                                        <input type="number" name="discount"
                                               onclick="this.select()" onblur="dueCalculate()" onkeyup="dueCalculate()"
                                               value="0" min="0" step="0.01" class="form-control low-height" required/>
                                    </div>
                                </td>
                            </tr>
                            <tr id="newBalance">
                                <th class="pt-2 pb-2 text-right">New Balance</th>
                                <td class="p-1">
                                    <div class="input-group">
                                        <input type="number" name="new_balance" value="0" min="0" step="0.01" class="form-control low-height" readonly/>
                                        <div class="input-group-append low-height">
                                            <span class="input-group-text new-balance-title" id="newBalanceTitle">Credit</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th class="p-1">
                                    <div class="row">
                                        <div class="col pr-1">
                                            <button type="submit" name="status" id="sale" value="1" class="btn btn-sm btn-primary mr-2"><i class="fa fa-save"></i> Transaction Complete</button>
                                        </div>
{{--                                        <div class="col pl-1">--}}
{{--                                            <button type="submit" name="status" id="order" value="2" class="btn btn-sm btn-block btn-warning"> Complete Order</button>--}}
{{--                                        </div>--}}
                                    </div>
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>

{{--    <div class="row">--}}
{{--        --}}
{{--        <div class="col-lg-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body" id="editForm">--}}
{{--                    <h5 class="card-title text-primary mb-3"><i class="bx bx-calculator"></i> Sale Summary</h5>--}}
{{--                    --}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.client.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.client.style') @endsection


