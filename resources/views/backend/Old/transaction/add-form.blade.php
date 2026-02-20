<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Other Income-Expense</h5>
    <form class="" action="{{ route('transaction-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text"> Type</label>
                        </div>
                        <select class="custom-select select2" name="transaction_type" onchange="sectorWiseAccountList()" required>
                            <option value="">--Select--</option>
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Sector</label>
                        </div>
                        <select class="custom-select select2" name="transaction_sector_id" onchange="sectorWiseAccountList()" required>
                            <option value="">--Select--</option>
                            @foreach($sectors as $sector)
                                <option value="{{ $sector->id }}" {{ old('transaction_sector_id') == $sector->id ? 'selected':'' }}>{{ $sector->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Account</label>
                        </div>
                        <select class="custom-select select2" name="transaction_item_id" required>
                            <option value="">--Select--</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Amount</span>
                        </div>
                        <input type="number" name="amount" onclick="this.select()" value="0" min="0" step="0.01" class="form-control" required/>
                        <div class="input-group-append">
                            <span class="input-group-text">Taka</span>
                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="col-lg-6">--}}
{{--                <div class="form-group">--}}
{{--                    <div class="input-group">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text">Media</span>--}}
{{--                        </div>--}}
{{--                        <select name="payment_media" onchange="paymentMedia()" class="form-control round-last-corner" required>--}}
{{--                            <option value="Cash">Cash</option>--}}
{{--                            <option value="Bank">Bank</option>--}}
{{--                        </select>--}}
{{--                        <div class="input-group-append" id="bank" style="min-width: 250px; display: none">--}}
{{--                            <select class="form-control " name="bank_account_id" style="border-bottom-left-radius: 0px; border-top-left-radius: 0px;">--}}
{{--                                <option value="">--Select Bank Account--</option>--}}
{{--                                @foreach(activeBankAccounts() as $account)--}}
{{--                                    <option value="{{ $account->id }}" {{ old('bank_account_id') == $account->id ? 'selected':'' }}>{{ $account->bank->code.': '.$account->ac_no }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Remark</span>
                        </div>
                        <input type="text" name="remark" class="form-control" placeholder="If any  . . ."/>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Via</span>
                        </div>
                        <input type="text" name="via" value="{{ user()->name }}" class="form-control" readonly/>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Submit</button>
                    <button type="reset" class="btn btn-warning"><i class="fa fa-times-circle"></i> Reset</button>
                </div>
            </div>
        </div>
    </form>
</div>
