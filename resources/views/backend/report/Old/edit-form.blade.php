<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Brand Edit Form</h5>
    <form class="" action="{{ route('brand-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-5 pr-md-0">
                <label class="sr-only">Brand Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Brand Name" required>
            </div>

            <div class="col col-md-5 pr-md-0">
                <label class="sr-only">Brand Code</label>
                <input type="text" name="code" class="form-control" placeholder="Enter Brand Code">
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
