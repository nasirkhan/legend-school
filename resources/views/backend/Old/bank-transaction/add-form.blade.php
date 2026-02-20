<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Bank Deposit/Withdrawal</h5>
    <form class="" action="{{ route('bank-transaction-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Account </label>
                        </div>
                        <select class="form-control" name="account_id" required>
                            <option value="">--Select--</option>
                            @foreach(activeBankAccounts() as $account)
                                <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected':'' }}>{{ $account->bank->code }}: {{ $account->ac_no }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Trans. Type</span>
                        </div>
                        <select class="form-control" name="type" required>
                            <option value="">--Select--</option>
                            <option value="Deposit">Deposit</option>
                            <option value="Withdrawal">Withdrawal</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Amount</span>
                        </div>
                        <input type="number" min="0" step="0.01" name="amount" value="{{ old('amount') }}" class="form-control" placeholder="Amount" required/>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Note</span>
                        </div>
                        <input type="text" name="note" value="{{ old('note') }}" class="form-control" placeholder="If any. . ."/>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Input Date</span>
                        </div>
                        <input type="date" name="input_date" value="{{ old('input_date') }}" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 text-right">
                <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Save</button>
                <button type="reset" class="btn btn-warning"><i class="fa fa-times-circle"></i> Reset</button>
            </div>
        </div>
    </form>
</div>
