@extends('backend.master')
@section('document-title') বকেয়া আদায় ও পরিশোধ পরিবর্তন @endsection
@section('page-title') বকেয়া আদায় ও পরিশোধ পরিবর্তন ফর্ম  @endsection
@section('active-breadcrumb-item') <a href="{{ route('due-transaction-form') }}">বকেয়া আদায় ও পরিশোধ পরিবর্তন</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <style>
        .table th{
            vertical-align: middle;
        }
    </style>

    <form class="due" action="{{ route('due-transaction-update',['id'=>$payment->id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12 pl-lg-0">
                <div class="card">
                    <div class="card-header font-weight-bold text-info f-s-small"><i class="bx bx-money"></i> পেমেন্টের বিবরণ</div>
                    <div class="card-body p-0">
                        <table class="table table-bordered mb-0">
                            <tbody>
                            <tr>
                                <th class="text-right low-height pt-2 pb-2" style="width: 150px">ক্লায়েন্টের ধরণ</th>
                                <td class="p-1">
                                    <select class="form-control p-1 low-height" onchange="client()" name="client_type" style="width: 100%" required>
                                        @foreach(activeClientTypes() as $type)
                                            @if($payment->client->type==$type->name)
                                                <option value="{{ $type->name }}">{{ siteInfo('language')=='bengali'? $type->bn_name : $type->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr id="client">
                                <th class="text-right low-height pt-2 pb-2">ক্লায়েন্ট</th>
                                <td class="p-1">
                                    <select class="form-control select2 p-1 low-height" onchange="clientBalance()" name="client_id" style="width: 100%">
                                        @foreach(activeClients($payment->client->type) as $client)
                                            <option value="{{ $client->id }}" {{ $client->id == $payment->client->id ? 'selected':'' }}>{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @php($oldBalance = clientLastBalance($payment->client_id,$payment->id))
                            <tr id="pastBalance">
                                <th class="pt-2 pb-2 text-right">ব্যালেন্স</th>
                                <td class="p-1">
                                    <div class="input-group">
                                        <input type="number" name="past_balance" value="{{ $oldBalance['balance'] }}" min="0" step="0.01" class="form-control low-height" readonly/>
                                        <div class="input-group-append low-height">
                                            <span class="input-group-text past-balance-title" id="pastBalanceTitle">{{ $oldBalance['title'] }}</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th class="pt-2 pb-2 text-right" id="amountTitle">আদায়</th>
                                <td class="p-1">
                                    <div class="input-group">
                                        <input type="number" name="amount"
                                               onclick="this.select()" onblur="dueCalculate()" onkeyup="dueCalculate()"
                                               value="{{ $payment->amount }}" min="0" step="0.01" class="form-control low-height"  required/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th class="pt-2 pb-2 text-right">মিডিয়া</th>
                                <td class="p-1">
                                    <select name="payment_media" onchange="paymentMedia()" class="form-control low-height p-1">
                                        <option value="Cash" {{ $payment->media =='Cash'?'selected':'' }}>নগদ ক্যাশ</option>
                                        <option value="Bank" {{ $payment->media =='Bank'?'selected':'' }}>ব্যাংক</option>
                                    </select>
                                </td>
                            </tr>

                            <tr id="bank" style="display: {{ $payment->media =='Bank'?'block':'none' }}">
                                <th class="pt-2 pb-2 text-right">একাউন্ট</th>
                                <td class="p-1">
                                    <select class="form-control p-1 low-height" name="bank_account_id">
                                        <option value="">--সিলেক্ট--</option>
                                        @foreach(activeBankAccounts() as $account)
                                            <option value="{{ $account->id }}" {{ ($payment->media=='Bank' and $payment->bankPayment->account_id==$account->id)? 'selected':'' }}>{{ $account->bank->code.': '.$account->ac_no }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr class="d-none">
                                <th class="pt-2 pb-2 text-right">ছাড়</th>
                                <td class="p-1">
                                    <div class="input-group">
                                        <input type="number" name="discount"
                                               onclick="this.select()" onblur="dueCalculate()" onkeyup="dueCalculate()"
                                               value="0" min="0" step="0.01" class="form-control low-height" required/>
                                    </div>
                                </td>
                            </tr>
                            <tr id="newBalance">
                                <th class="pt-2 pb-2 text-right">নতুন ব্যালেন্স</th>
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
                                            <button type="submit" name="status" id="sale" value="1" class="btn btn-sm btn-primary mr-2" style="font-size: 13px"><i class="fa fa-save"></i> পেমেন্ট সম্পন্ন করুন</button>
                                        </div>
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
@endsection
{{--this script override all--}}
@section('script') @include('backend.client.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.client.style') @endsection

@section('special-js')
    <script>
        dueCalculate();
    </script>
@endsection


