<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Account</h5>
    <form class="" action="{{ route('transaction-item-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-3 pr-lg-0">
                <div class="input-group">
                    <label class="sr-only">Sector</label>
                    <select class="form-control" name="transaction_sector_id" id="transaction_sector_id" style="border-radius: 4px" required>
                        <option value="">--Select Sector--</option>
                        @foreach(sectors() as $sector)
                            <option value="{{ $sector->id }}">Sector: {{ $sector->name }}</option>
                        @endforeach
                        <option value="new">New Sector</option>
                    </select>
                    <input type="text" name="sector_name" class="form-control" style="display: none" id="newSectorName" placeholder="Sector Name" aria-label="Sector Name">
                </div>
            </div>

            <div class="col-lg-3 pr-lg-0">
                <div class="form-group">
                    <label class="sr-only">Account Name</label>
                    <input type="text" name="account_name" class="form-control" value="{{ old('account_name') }}" placeholder="Account Name">
                </div>
            </div>

            <div class="col-lg-2 pr-lg-0">
                <div class="form-group">
                    <label class="sr-only">Account Type</label>
                    <select class="form-control" name="account_type" required>
                        <option value="">--Select Account Type--</option>
                        <option value="Debit">Type: Debit</option>
                        <option value="Credit">Type: Credit</option>
{{--                        <option value="All">All</option>--}}
                    </select>
                </div>
            </div>

            <div class="col-lg-2 pr-lg-0">
                <div class="form-group">
                    <label class="sr-only">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Mobile No.">
                </div>
            </div>

            <div class="col-lg-2 pr-lg-0">
                <div class="form-group">
                    <label class="sr-only">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Address">
                </div>
            </div>

            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                <button type="submit" class="btn btn-warning"><i class="fa fa-trash-alt"></i> Reset</button>
            </div>
        </div>
    </form>
</div>
