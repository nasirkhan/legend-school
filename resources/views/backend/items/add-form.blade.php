<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Item</h5>
    <form class="" action="{{ route('item-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-lg-5 pr-lg-0 col-md-4 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Item Name</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter Item Name" required>
                </div>
            </div>

            <div class="col col-lg-3 pr-lg-0 col-md-3 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Used For</span>
                    </div>
                    <select name="used_for" class="form-control" id="used_for" required>
                        <option value="">--Select--</option>
                        <option value="1" {{ Session::get('used_for') == 1 ? 'selected':'' }}>Students</option>
                        <option value="2" {{ Session::get('used_for') == 2 ? 'selected':'' }}>Office Staff</option>
                    </select>
                </div>
            </div>

            <div class="col col-lg-3 pr-lg-0 col-md-3 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Billing Cycle</span>
                    </div>
                    <select name="billing_cycle" class="form-control" id="billing_cycle" required>
                        <option value="">--Select--</option>
                        <option value="1" {{ Session::get('billing_cycle') == 1 ? 'selected':'' }}>One Time</option>
                        <option value="2" {{ Session::get('billing_cycle') == 2 ? 'selected':'' }}>Yearly</option>
                        <option value="3" {{ Session::get('billing_cycle') == 3 ? 'selected':'' }}>Monthly</option>
                        <option value="4" {{ Session::get('billing_cycle') == 4 ? 'selected':'' }}>Any Time</option>
                    </select>
                </div>
            </div>

            <div class="col col-lg-1 col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
