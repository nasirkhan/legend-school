<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Category</h5>
    <form class="" action="{{ route('category-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-10 pr-md-0">
                <label class="sr-only" for="name">Category Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Category Name">
            </div>

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
