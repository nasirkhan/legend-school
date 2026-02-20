<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">Category Edit Form</h5>
    <form class="" action="{{ route('category-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-10 pr-md-0">
                <label class="sr-only" for="name">Category Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Name" required>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
