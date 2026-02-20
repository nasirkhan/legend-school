<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Bank Add Form</h5>
    <form class="" action="{{ route('bank-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="form-group">
                    <label class="sr-only">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Bank Name" required>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label class="sr-only">Code</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder="Enter Code" required>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group row">
                    <div class="col"><button type="submit" class="btn btn-block btn-primary mr-2">Save</button></div>
                    <div class="col"><button type="reset" class="btn btn-block btn-warning">Reset</button></div>
                </div>
            </div>
        </div>
    </form>
</div>
