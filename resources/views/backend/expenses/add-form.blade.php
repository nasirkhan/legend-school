<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Make Transaction</h5>
    <form class="" action="{{ route('expense-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-3 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Year</span>
                    </div>
                    <select class="form-control" name="year">
                        <option value="">--Select--</option>
                        @foreach (activeYears() as $year)
                            <option value="{{ $year->year }}" {{ Session::get('year') == $year->year ? 'selected' : '' }}>{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>

                <span class="text-danger">{{ $errors->first('year') }}</span>
            </div>

            <div class="col-lg-3 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Month</span>
                    </div>
                    <select class="form-control" name="month_id">
                        <option value="">--Select--</option>
                        @foreach (months() as $month)
                            <option value="{{ $month->id }}" {{ Session::get('month_id') == $month->id ? 'selected' : '' }}>{{ $month->name }}</option>
                        @endforeach
                    </select>
                </div>

                <span class="text-danger">{{ $errors->first('month_id') }}</span>
            </div>

            <div class="col-lg-3 pr-lg-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Item</span>
                    </div>
                    <select class="form-control select2" name="expense_item_id">
                        <option value="">--Select--</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" {{ Session::get('expense_item_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="text-danger">{{ $errors->first('expense_item_id') }}</span>
            </div>

            <div class="col-lg-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Account</span>
                    </div>
                    <select class="form-control select2" name="beneficiary_id">
                        <option value="">--Select--</option>
                        @foreach ($beneficiaries as $beneficiary)
                            <option value="{{ $beneficiary->id }}">{{ $beneficiary->name }}</option>
                        @endforeach
                    </select>
                </div>

                <span class="text-danger">{{ $errors->first('beneficiary_id') }}</span>
            </div>

            <div class="col-lg-3 pr-lg-0 mt-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Transaction Type</span>
                    </div>
                    <select class="form-control" name="transaction_type">
                        <option value="">--Select--</option>
                        <option value="1" {{ old('transaction_type') == 1 ? 'selected' : '' }}>Income</option>
                        <option value="2" {{ old('transaction_type') == 2 ? 'selected' : '' }}>Expense</option>
                    </select>
                </div>
                <span class="text-danger">{{ $errors->first('transaction_type') }}</span>
            </div>

            <div class="col-lg-3 pr-lg-0 mt-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Amount</span>
                    </div>
                    <input type="text" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="0.00">
                    <div class="input-group-append">
                        <span class="input-group-text">Taka</span>
                    </div>
                </div>

                <span class="text-danger">{{ $errors->first('amount') }}</span>
            </div>

            <div class="col-lg-3 pr-lg-0 mt-2">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Media</span>
                    </div>
                    <select class="form-control" name="media">
                        <option value="">--Select--</option>
                        <option value="1" {{ old('media') == 1 ? 'selected' : '' }}>Cash</option>
                        <option value="2" {{ old('media') == 1 ? 'selected' : '' }}>Bank</option>
                    </select>
                </div>
                <span class="text-danger">{{ $errors->first('media') }}</span>
            </div>

            <div class="col-lg-3 mt-2">
                <div class="input-group ">
                    <input type="text" class="form-control" name="reference" value="{{ old('reference') }}" placeholder="Ref. for Bank Payment">
                </div>
            </div>

            <div class="col-lg-3 pr-lg-0 mt-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Bearer</span>
                    </div>
                    <input type="text" class="form-control" name="bearer" value="{{ old('bearer') }}" placeholder="Write bearer name">
                </div>

                <span class="text-danger">{{ $errors->first('bearer') }}</span>
            </div>

            <div class="col-lg-3 pr-lg-0 mt-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Contact No.</span>
                    </div>
                    <input type="text" class="form-control" name="contact_no" value="{{ old('contact_no') }}" placeholder="Bearer Mobile No">
                </div>

                <span class="text-danger">{{ $errors->first('contact_no') }}</span>
            </div>

            <div class="col-lg-3 pr-lg-0 mt-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Note</span>
                    </div>
                    <input type="text" class="form-control" name="note" value="{{ old('note') }}" placeholder="Write note here if any">
                </div>
            </div>

            <div class="col-lg-3 mt-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Date</span>
                    </div>
                    <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                </div>
            </div>

            <div class="col-lg-12 mt-2">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Transaction Save </button>
            </div>
        </div>
    </form>
</div>
