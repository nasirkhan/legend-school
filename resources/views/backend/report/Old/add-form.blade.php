<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Client Add Form</h5>
    <form class="" action="{{ route('client-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Client Type</label>
                    <select name="type" class="form-control" required>
                        <option value="">--Client Type--</option>
                        @foreach(activeClientTypes() as $type)
                            <option value="{{ $type->name }}" {{ old('type')==$type->name ? 'selected':'' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Client Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Client Name" required>
                </div>
            </div>

            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Client Mobile</label>
                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Enter Client Mobile">
                </div>
            </div>

            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Client Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Enter Client Address">
                </div>
            </div>

            <div class="col col-md-6">
                <div class="form-group">
                    <label class="sr-only">Initial Balance</label>
                    <input type="number" min="0" step="1" name="initial_balance" class="form-control" value="{{ old('initial_balance') }}" placeholder="Enter Client Initial Balance" required>
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
        </div>

        <div class="row">
            <div class="col text-right">
                <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Save</button>
                <button type="reset" class="btn btn-warning"><i class="fa fa-times-circle"></i> Reset</button>
            </div>
        </div>
    </form>
</div>
