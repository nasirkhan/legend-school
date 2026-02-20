<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Month</h5>
    <form class="" action="{{ route('month-save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col col-md-5 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Month Name</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter name" required>
                </div>
            </div>

            <div class="col col-md-5 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Month Code</span>
                    </div>
                    <input type="text" name="code" class="form-control" id="code" value="{{ old('code') }}" placeholder="Enter code" required>
                </div>
            </div>

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
