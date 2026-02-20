<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Unit</h5>
    <form class="" action="{{ route('unit-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-4 pr-md-0">
                <label class="sr-only">Category</label>
                <select class="form-control" name="measurement_category_id" required>
                    <option value="">--Select Measurement Type--</option>
                    @foreach(measurementCategories() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col col-md-3 pr-md-0">
                <label class="sr-only">Unit Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Unit Name" required>
            </div>

            <div class="col col-md-3 pr-md-0">
                <label class="sr-only">Unit Code</label>
                <input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder="Unit Code">
            </div>

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
