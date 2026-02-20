<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Day</h5>
    <form class="" action="{{ route('day-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-6 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Day Name</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter Day Name" required>
                </div>
            </div>

            <div class="col col-md-4 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Day Code</span>
                    </div>
                    <input type="text" name="code" class="form-control" id="code" value="{{ old('code') }}" placeholder="Enter Day Code" required>
                </div>
            </div>

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
