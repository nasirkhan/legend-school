<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Income-Expense Item Edit Form</h5>
    <form class="" action="{{ route('expense-item-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-lg-7 pr-lg-0 col-md-7 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Item Name</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Item Name" required>
                </div>
            </div>

            <div class="col col-lg-4 pr-lg-0 col-md-4 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Item Type</span>
                    </div>
                    <select name="type" class="form-control" id="type" required>
                        <option value="">Select Item Type</option>
                        <option value="expense">Expense</option>
                        <option value="income">Income</option>
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
