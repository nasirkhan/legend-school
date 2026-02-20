<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Income-Expense Item</h5>
    <form class="" action="{{ route('expense-item-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-lg-7 pr-lg-0 col-md-7 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Item Name</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter Expense Item Name" autofocus required>
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

            <div class="col col-lg-1 col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
