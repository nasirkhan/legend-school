<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Expense Item Edit Form</h5>
    <form class="" action="{{ route('expense-item-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-lg-11 pr-lg-0 col-md-11 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Item Name</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Expense Item Name" required>
                </div>
            </div>

            <input type="hidden" name="id">

            <div class="col col-lg-1 col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
