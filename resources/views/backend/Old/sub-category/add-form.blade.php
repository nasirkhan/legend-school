<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">New Sub-Category</h5>
    <form class="" action="{{ route('sub-category-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-5 pr-md-0">
                <label class="sr-only" for="name">Category </label>
                <select name="category_id" class="form-control" id="category_id" required>
                    <option value="">--Select Category--</option>
                    @foreach(categories() as $category)
                        <option value="{{ $category->id }}">Category: {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col col-md-5 pr-md-0">
                <label class="sr-only" for="name">Sub-Category Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Sub Category Name">
            </div>

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
