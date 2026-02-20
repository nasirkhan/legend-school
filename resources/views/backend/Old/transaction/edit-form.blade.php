<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Transaction Sector Edit Form</h5>
    <form class="" action="{{ route('transaction-sector-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-10 pr-lg-0">
                <label class="sr-only">Unit Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Unit Name" required>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col-lg-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
