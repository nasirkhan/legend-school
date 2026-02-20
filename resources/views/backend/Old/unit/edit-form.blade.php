<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">একক পরিবর্তন করুন</h5>
    <form class="" action="{{ route('unit-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-4 pr-md-0">
                <label class="sr-only">Category</label>
                <select class="form-control" name="measurement_category_id" required>
                    <option value="">--Select Measurement Category--</option>
                    @foreach(measurementCategories() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col col-md-3 pr-md-0">
                <label class="sr-only">Unit Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Unit Name" required>
            </div>

            <div class="col col-md-3 pr-md-0">
                <label class="sr-only">Unit Code</label>
                <input type="text" name="code" class="form-control" placeholder="Enter Unit Code">
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> আপডেট করুন</button>
            </div>
        </div>
    </form>
</div>
