<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Transaction Sector Add Form</h5>
    <form class="" action="{{ route('transaction-sector-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-10 pr-lg-0">
                <label class="sr-only">Unit Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Transaction Sector Name" required>
            </div>

            <div class="col-lg-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
