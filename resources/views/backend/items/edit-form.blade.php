<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Transaction Item Edit Form</h5>
    <form class="" action="{{ route('item-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-lg-5 pr-lg-0 col-md-4 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Item Name</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Item Name" required>
                </div>
            </div>

            <div class="col col-lg-3 pr-lg-0 col-md-3 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Used For</span>
                    </div>
                    <select name="used_for" class="form-control" id="used_for" required>
                        <option value="">--Select--</option>
                        <option value="1">Students</option>
                        <option value="2">Office Staff</option>
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
                        <option value="1">One Time</option>
                        <option value="2">Yearly</option>
                        <option value="3">Monthly</option>
                        <option value="4">Any Time</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="id">

            <div class="col col-lg-1 col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
