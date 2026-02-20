<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New ECA Type</h5>
    <form class="" action="{{ route('eca-type-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-7 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ECA Type</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter ECA Type" required>
                </div>
            </div>

            <div class="col col-md-3 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Code</span>
                    </div>
                    <input type="text" name="code" class="form-control" id="code" value="{{ old('code') }}" placeholder="Enter Code" required>
                </div>
            </div>

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
