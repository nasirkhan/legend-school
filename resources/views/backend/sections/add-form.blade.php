<div class="card-body" id="addForm">
    <h5 class="card-title text-primary mb-3">Add New Section</h5>
    <form class="" action="{{ route('section-save') }}" method="POST">
        @csrf
        <div class="row">

            <div class="col col-md-6 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Section Name</span>
                    </div>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter Section Name">
                </div>
            </div>

            <div class="col col-md-4 pr-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Result Type</span>
                    </div>
                    <select class="form-control" name="result_type">
                        <option value="">--Select--</option>
                        <option value="n">Normal</option>
                        <option value="a">Average</option>
                        <option value="w">Weighted Average</option>
                    </select>
                </div>
            </div>

            <div class="col col-md-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
