<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Bank Account Edit Form <button onclick="showAddForm()" class="btn btn-sm btn-secondary">Add New</button></h5>
    <form class="" action="{{ route('bank-account-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Name</label>
                    <select class="form-control" name="bank_id" required>
                        <option value="">--Select Bank--</option>
                        @foreach(activeBanks() as $bank)
                            <option value="{{ $bank->id }}" {{ old('bank_id') == $bank->id ? 'selected':'' }}>{{ $bank->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Account Name</label>
                    <input type="text" name="ac_name" class="form-control" value="{{ old('ac_name') }}" placeholder="Enter Account Name">
                </div>
            </div>

            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Account Number</label>
                    <input type="text" name="ac_no" class="form-control" value="{{ old('ac_no') }}" placeholder="Enter Account Number">
                </div>
            </div>

            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Branch</label>
                    <input type="text" name="branch" class="form-control" value="{{ old('branch') }}" placeholder="Enter Branch Name">
                </div>
            </div>

            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Enter Branch Address">
                </div>
            </div>

            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Contact No.</label>
                    <input type="text" name="contact_no" class="form-control" value="{{ old('contact_no') }}" placeholder="Enter Contact No">
                </div>
            </div>



            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Initial Balance</label>
                    <input type="number" min="0" step="1" name="initial_balance" class="form-control" value="{{ old('initial_balance') }}" placeholder="Enter Initial Balance" required>
                </div>
            </div>

            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Initial Balance Type</label>
                    <select name="balance_type" class="form-control" required>
                        <option value="">--Balance Type--</option>
                        <option value="Credit" {{ old('balance_type') == 'Credit'? 'selected':'' }}>Credit</option>
                        <option value="Debit" {{ old('balance_type') == 'Debit'? 'selected':'' }}>Debit</option>
                    </select>
                </div>
            </div>

            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Last Transaction Date</label>
                    <input type="date" name="last_transaction_date" class="form-control" value="{{ old('last_transaction_date') }}" placeholder="Last Transaction Date" required>
                </div>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-6">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Update</button>
            </div>
        </div>
    </form>
</div>
