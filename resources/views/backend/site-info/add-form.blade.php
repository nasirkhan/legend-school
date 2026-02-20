<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Company Add Form</h5>
    <form class="" action="{{ route('brand-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-5 pr-md-0">
                <label class="sr-only">Company Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Company Name" required>
            </div>

            <div class="col col-md-5 pr-md-0">
                <label class="sr-only">Company Code</label>
                <input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder="Enter Company Code">
            </div>

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
